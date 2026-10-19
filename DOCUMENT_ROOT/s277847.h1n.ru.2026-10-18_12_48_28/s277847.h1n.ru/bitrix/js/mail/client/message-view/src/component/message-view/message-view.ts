import { Dom } from 'main.core';
import { type ComponentOptions, type PropType } from 'ui.vue3';

import { type ThreadState } from '../../feature/thread/thread';
import { type ActionMenuIntent, type ActionsState } from '../../feature/actions/actions';
import {
	type ExternalHostStatus,
	type MailAddressViewModel,
	type MessageViewState,
} from '../../model/types';
import {
	ActionBarComponent,
	type ActionBarActionIntent,
	type ActionBarLegacyAttributes,
	type ActionBarLabels,
} from '../action-bar/action-bar';
import {
	AttachmentsComponent,
	type AttachmentsComponentLabels,
	type AttachmentsIntent,
	type AttachmentsRefreshIntent,
	type AttachmentsState,
} from '../attachments/attachments';
import {
	ThreadComponent,
	type ThreadComponentLabels,
	type ThreadLoadSideIntent,
	type ThreadRetryItemIntent,
	type ThreadToggleItemIntent,
} from '../thread/thread';

type RecipientGroup = {
	code: string,
	label: string,
	items: MailAddressViewModel[],
	visibleItems: MailAddressViewModel[],
	hiddenItems: MailAddressViewModel[],
};

type SurfaceContextListener = (contextClass: string) => void;

export type MailtoIntent = {
	readonly email: string,
};

const LegacyHostAttribute = 'data-mail-message-view-host';
const DarkThemeClass = 'bitrix24-dark-theme';
const surfaceContextObservers = new WeakMap<object, MutationObserver>();

export function getSurfaceContextClass(): string
{
	return Dom.hasClass(document.documentElement, DarkThemeClass)
		|| Dom.hasClass(document.body, DarkThemeClass)
		? '--ui-context-content-dark'
		: '--ui-context-content-light'
	;
}

export function observeSurfaceContext(owner: object, listener: SurfaceContextListener): void
{
	disconnectSurfaceContext(owner);
	const observer = new MutationObserver(() => {
		listener(getSurfaceContextClass());
	});
	observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
	observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
	surfaceContextObservers.set(owner, observer);
}

export function disconnectSurfaceContext(owner: object): void
{
	surfaceContextObservers.get(owner)?.disconnect();
	surfaceContextObservers.delete(owner);
}

// @vue/component
export const MessageViewComponent = {
	name: 'MailMessageViewComponent',
	components: {
		ActionBarComponent,
		AttachmentsComponent,
		ThreadComponent,
	},
	props: {
		state: {
			type: Object as PropType<MessageViewState>,
			required: true,
		},
		threadState: {
			type: Object as PropType<ThreadState | null>,
			default: null,
		},
		threadLabels: {
			type: Object as PropType<ThreadComponentLabels | null>,
			default: null,
		},
		actionsState: {
			type: Object as PropType<ActionsState | null>,
			default: null,
		},
		actionLabels: {
			type: Object as PropType<ActionBarLabels | null>,
			default: null,
		},
		actionLegacyAttributes: {
			type: Object as PropType<ActionBarLegacyAttributes>,
			default: () => ({}),
		},
		attachmentsState: {
			type: Object as PropType<AttachmentsState | null>,
			default: null,
		},
		attachmentLabels: {
			type: Object as PropType<AttachmentsComponentLabels | null>,
			default: null,
		},
	},
	emits: {
		action: (payload?: ActionBarActionIntent): boolean => Boolean(payload),
		'action-menu': (payload?: ActionMenuIntent): boolean => Boolean(payload),
		mailto: (payload?: MailtoIntent): boolean => Boolean(payload?.email),
		'attachments-refresh': (payload?: AttachmentsRefreshIntent): boolean => Boolean(payload),
		'attachments-intent': (payload?: AttachmentsIntent): boolean => Boolean(payload),
		'load-side': (payload?: ThreadLoadSideIntent): boolean => {
			return payload?.side === 'before' || payload?.side === 'after';
		},
		'toggle-item': (payload?: ThreadToggleItemIntent): boolean => {
			return Boolean(
				payload
				&& Number.isInteger(payload.id)
				&& (payload.side === 'before' || payload.side === 'after')
				&& payload.rowHostId
				&& payload.detailsHostId,
			);
		},
		'retry-item': (payload?: ThreadRetryItemIntent): boolean => {
			return Boolean(
				payload
				&& Number.isInteger(payload.id)
				&& (payload.side === 'before' || payload.side === 'after')
				&& payload.detailsHostId,
			);
		},
	},
	data(): { surfaceContextClass: string, expandedRecipientGroups: Record<string, boolean> }
	{
		return {
			surfaceContextClass: getSurfaceContextClass(),
			expandedRecipientGroups: {},
		};
	},
	computed: {
		hasThread(): boolean
		{
			return Boolean(this.threadState && this.threadLabels);
		},
		recipientGroups(): RecipientGroup[]
		{
			return [
				{
					code: 'to',
					label: this.state.currentMessage.labels.to,
					items: this.state.currentMessage.recipients.to,
				},
				{
					code: 'cc',
					label: this.state.currentMessage.labels.cc,
					items: this.state.currentMessage.recipients.cc,
				},
				{
					code: 'bcc',
					label: this.state.currentMessage.labels.bcc,
					items: this.state.currentMessage.recipients.bcc,
				},
			]
				.filter((group) => group.items.length > 0)
				.map((group, index) => {
					const threshold = index === 0 ? 4 : 2;
					const visibleCount = group.items.length > threshold ? threshold - 1 : group.items.length;

					return {
						...group,
						visibleItems: group.items.slice(0, visibleCount),
						hiddenItems: group.items.slice(visibleCount),
					};
				});
		},
		deliveryDate(): string
		{
			return this.state.currentMessage.date.formatted;
		},
		shouldShowSenderEmail(): boolean
		{
			return this.shouldShowAddressEmail(this.state.currentMessage.sender);
		},
		hasAttachmentsHost(): boolean
		{
			return this.state.hosts.attachments.enabled;
		},
		hasQuickReplyHost(): boolean
		{
			return this.state.hosts.compose.enabled && this.state.capabilities.quickReply;
		},
	},
	mounted(): void
	{
		observeSurfaceContext(this, (contextClass) => {
			this.surfaceContextClass = contextClass;
		});
	},
	beforeUnmount(): void
	{
		disconnectSurfaceContext(this);
	},
	methods: {
		getAddressText(address: MailAddressViewModel): string
		{
			return address.name || address.email;
		},
		shouldShowAddressEmail(address: MailAddressViewModel): boolean
		{
			return Boolean(address.name && address.email && address.name !== address.email);
		},
		getAddressHref(address: MailAddressViewModel): string | null
		{
			if (address.href && address.href.toLowerCase().startsWith('mailto:'))
			{
				return address.href;
			}

			return null;
		},
		getAvatarText(address: MailAddressViewModel): string
		{
			const initials = address.avatar.initials || this.getAddressText(address).slice(0, 1);

			return initials.toUpperCase();
		},
		getAvatarImageUrl(address: MailAddressViewModel): string | null
		{
			return address.avatar.image ? this.getSafeExternalUrl(address.avatar.image) : null;
		},
		getAvatarStyle(address: MailAddressViewModel): Record<string, string>
		{
			const color = address.avatar.color;

			return color && /^#[\da-f]{6}$/i.test(color) ? { backgroundColor: color } : {};
		},
		getRecipientListId(group: RecipientGroup): string
		{
			return `mail-message-view-current-recipients-${this.state.currentMessage.id}-${group.code}`;
		},
		isRecipientGroupExpanded(group: RecipientGroup): boolean
		{
			return this.expandedRecipientGroups[group.code] === true;
		},
		expandRecipientGroup(group: RecipientGroup): void
		{
			this.expandedRecipientGroups[group.code] = true;
		},
		getRecipientMoreLabel(group: RecipientGroup): string
		{
			return this.state.currentMessage.labels.moreRecipients.replace(
				'#NUM#',
				String(group.hiddenItems.length),
			);
		},
		getSyncMailboxLabelPart(index: 0 | 1): string
		{
			const [beforeLink, ...afterLink] = this.state.currentMessage.labels.syncMailbox.split('#LINK#');

			return index === 0 ? beforeLink : afterLink.join('#LINK#');
		},
		getHostStatusClass(status: ExternalHostStatus): string
		{
			return `mail-message-view-host-${status}`;
		},
		getHostAttribute(hostId: string): Record<string, string>
		{
			return {
				[LegacyHostAttribute]: hostId,
			};
		},
		getSafeExternalUrl(url: string): string | null
		{
			try
			{
				const parsedUrl = new URL(url, window.location.href);
				if (['http:', 'https:'].includes(parsedUrl.protocol))
				{
					return parsedUrl.href;
				}
			}
			catch
			{
				return null;
			}

			return null;
		},
		handleThreadLoadSide(payload: ThreadLoadSideIntent): void
		{
			this.$emit('load-side', payload);
		},
		handleThreadToggleItem(payload: ThreadToggleItemIntent): void
		{
			this.$emit('toggle-item', payload);
		},
		handleThreadRetryItem(payload: ThreadRetryItemIntent): void
		{
			this.$emit('retry-item', payload);
		},
		handleAction(payload: ActionBarActionIntent): void
		{
			this.$emit('action', payload);
		},
		handleActionMenu(payload: ActionMenuIntent): void
		{
			this.$emit('action-menu', payload);
		},
		handleMailto(address: MailAddressViewModel): void
		{
			if (address.email)
			{
				this.$emit('mailto', { email: address.email });
			}
		},
		handleAttachmentsRefresh(payload: AttachmentsRefreshIntent): void
		{
			this.$emit('attachments-refresh', payload);
		},
		handleAttachmentsIntent(payload: AttachmentsIntent): void
		{
			this.$emit('attachments-intent', payload);
		},
	},
	template: `
		<div
			class="mail-msg-view-shell mail-message-view-shell"
			:class="surfaceContextClass"
			:data-message-id="state.currentMessage.id"
			:data-uid-key="state.domContracts.messageUidKey"
		>
			<header class="mail-msg-view-page-header" :data-testid="state.domContracts.testIds.header">
				<h1
					:id="state.domContracts.ids.pageTitle"
					class="mail-msg-view-page-title"
					:data-testid="state.domContracts.testIds.title"
				>
					{{ state.screen.title }}
				</h1>
				<div class="mail-msg-view-page-actions">
					<div
						v-if="state.hosts.actions.enabled"
						:id="state.hosts.actions.id"
						class="mail-message-view-host mail-message-view-actions-host"
						v-bind="getHostAttribute(state.hosts.actions.id)"
					></div>
					<div
						:id="state.hosts.pageSwapper.id"
						class="mail-msg-header-page-swapper mail-message-view-host"
						:data-testid="state.domContracts.testIds.navigation"
						:data-host-enabled="state.hosts.pageSwapper.enabled ? 'true' : 'false'"
						v-bind="getHostAttribute(state.hosts.pageSwapper.id)"
					></div>
				</div>
			</header>
			<div class="mail-msg-view-scroll-area" :data-testid="state.domContracts.testIds.scrollArea">
				<div
					class="mail-msg-view-wrapper mail-msg-view-read"
					:id="state.domContracts.ids.root"
					tabindex="-1"
					data-read-redesign="true"
					:data-testid="state.domContracts.testIds.root"
					:data-message-id="state.currentMessage.id"
					:data-uid-key="state.domContracts.messageUidKey"
				>
					<div
						v-if="state.currentMessage.sendError"
						class="ui-alert ui-alert-warning mail-message-view-send-error"
						role="alert"
						data-testid="mail-message-view-send-error"
					>
						<span class="ui-alert-message">{{ state.currentMessage.sendError }}</span>
					</div>
					<ThreadComponent
						v-if="hasThread"
						:side-state="threadState.before"
						:labels="threadLabels"
						@load-side="handleThreadLoadSide"
						@toggle-item="handleThreadToggleItem"
						@retry-item="handleThreadRetryItem"
					/>
					<div
						class="mail-msg-view-details"
						:id="state.domContracts.ids.currentDetails"
						:data-id="state.currentMessage.id"
					>
						<div class="mail-msg-view-border-bottom">
							<div class="mail-msg-view-header mail-message-view-current-card">
								<span
									class="mail-msg-view-header-userpic mail-message-view-avatar"
									:style="getAvatarStyle(state.currentMessage.sender)"
									aria-hidden="true"
								>
									<img
										v-if="getAvatarImageUrl(state.currentMessage.sender)"
										class="mail-message-view-avatar-image"
										:src="getAvatarImageUrl(state.currentMessage.sender)"
										alt=""
									>
									<template v-else>{{ getAvatarText(state.currentMessage.sender) }}</template>
								</span>
								<span class="mail-msg-view-header-info">
									<span class="mail-msg-view-sender-block">
										<span class="mail-msg-view-sender">
											<a
												v-if="getAddressHref(state.currentMessage.sender)"
												class="mail-msg-view-sender-name js-mailto-link"
												:href="getAddressHref(state.currentMessage.sender)"
												:aria-label="state.currentMessage.labels.sender + ': ' + getAddressText(state.currentMessage.sender)"
												:data-testid="state.domContracts.testIds.senderName"
												@click.prevent="handleMailto(state.currentMessage.sender)"
											>{{ getAddressText(state.currentMessage.sender) }}</a>
											<span
												v-else
												class="mail-msg-view-sender-name"
												:data-testid="state.domContracts.testIds.senderName"
											>{{ getAddressText(state.currentMessage.sender) }}</span>
											<a
												v-if="shouldShowSenderEmail && getAddressHref(state.currentMessage.sender)"
												class="mail-msg-view-sender-email js-mailto-link"
												:href="getAddressHref(state.currentMessage.sender)"
												:data-testid="state.domContracts.testIds.senderEmail"
												@click.prevent="handleMailto(state.currentMessage.sender)"
											>{{ state.currentMessage.sender.email }}</a>
										</span>
										<span class="mail-msg-view-date">
											{{ deliveryDate }}
											<span
												v-if="state.currentMessage.date.readConfirmedFormatted"
												class="mail-message-view-read-confirmed read-confirmed-datetime"
												data-testid="mail-message-view-read-confirmed"
											>, {{ state.currentMessage.date.readConfirmedFormatted }}</span>
										</span>
									</span>
									<div class="mail-msg-view-rcpt-wrapper">
										<span
											v-for="group in recipientGroups"
											:key="group.code"
											class="mail-message-view-recipient-group"
										>
											<span class="mail-msg-view-rcpt-list">{{ group.label }}:</span>
											<span
												v-for="(recipient, index) in group.visibleItems"
												:key="group.code + '-' + recipient.email + '-' + index"
												class="mail-msg-view-rcpt-block mail-msg-list-cell-flex"
												:data-testid="state.domContracts.testIds.recipient"
											>
												<span
													class="mail-message-view-recipient-avatar"
													:style="getAvatarStyle(recipient)"
													aria-hidden="true"
												>
													<img
														v-if="getAvatarImageUrl(recipient)"
														class="mail-message-view-avatar-image"
														:src="getAvatarImageUrl(recipient)"
														alt=""
													>
													<template v-else>{{ getAvatarText(recipient) }}</template>
												</span>
												<a
													v-if="getAddressHref(recipient)"
													class="mail-msg-view-rcpt-link js-mailto-link"
													:href="getAddressHref(recipient)"
													:title="recipient.title"
													:aria-label="group.label + ': ' + getAddressText(recipient)"
													:data-testid="state.domContracts.testIds.recipientEmail"
													@click.prevent="handleMailto(recipient)"
												>{{ getAddressText(recipient) }}</a>
												<span v-else class="mail-msg-view-rcpt">{{ getAddressText(recipient) }}</span>
											</span>
											<button
												v-if="group.hiddenItems.length > 0"
												type="button"
												class="mail-message-view-recipient-more"
												data-testid="mail-message-view-recipients-toggle"
												:aria-expanded="isRecipientGroupExpanded(group) ? 'true' : 'false'"
												:aria-controls="getRecipientListId(group)"
												@click="expandRecipientGroup(group)"
											>{{ getRecipientMoreLabel(group) }}</button>
											<span
												v-if="group.hiddenItems.length > 0"
												:id="getRecipientListId(group)"
												class="mail-message-view-recipient-hidden"
												:hidden="!isRecipientGroupExpanded(group)"
											>
												<span
													v-for="(recipient, index) in group.hiddenItems"
													:key="group.code + '-hidden-' + recipient.email + '-' + index"
													class="mail-msg-view-rcpt-block mail-msg-list-cell-flex"
													:data-testid="state.domContracts.testIds.recipient"
												>
													<span
														class="mail-message-view-recipient-avatar"
														:style="getAvatarStyle(recipient)"
														aria-hidden="true"
													>
														<img
															v-if="getAvatarImageUrl(recipient)"
															class="mail-message-view-avatar-image"
															:src="getAvatarImageUrl(recipient)"
															alt=""
														>
														<template v-else>{{ getAvatarText(recipient) }}</template>
													</span>
													<a
														v-if="getAddressHref(recipient)"
														class="mail-msg-view-rcpt-link js-mailto-link"
														:href="getAddressHref(recipient)"
														:title="recipient.title"
														:aria-label="group.label + ': ' + getAddressText(recipient)"
														:data-testid="state.domContracts.testIds.recipientEmail"
														@click.prevent="handleMailto(recipient)"
													>{{ getAddressText(recipient) }}</a>
													<span v-else class="mail-msg-view-rcpt">{{ getAddressText(recipient) }}</span>
												</span>
											</span>
										</span>
									</div>
									<div
										v-if="state.hosts.labels.enabled"
										:id="state.hosts.labels.id"
										class="mail-additional mail-msg-bind-chips mail-message-view-host"
										v-bind="getHostAttribute(state.hosts.labels.id)"
									></div>
								</span>
							</div>
							<ActionBarComponent
								v-if="state.hosts.actions.enabled && actionsState && actionLabels"
								v-show="state.body.status !== 'loading'"
								:state="actionsState"
								:labels="actionLabels"
								:legacy-action-attributes="actionLegacyAttributes"
								@action="handleAction"
								@menu="handleActionMenu"
							/>
							<div
								v-if="state.currentMessage.flags.isSyncError"
								class="mail-message-view-sync-warning"
							>
								<template v-if="state.currentMessage.mailbox && getSafeExternalUrl(state.currentMessage.mailbox.uri)">
									{{ getSyncMailboxLabelPart(0) }}
									<a
										:href="getSafeExternalUrl(state.currentMessage.mailbox.uri)"
										target="_blank"
										rel="noopener noreferrer"
										data-testid="mail-message-view-mailbox-link"
									>{{ state.currentMessage.mailbox.host }}</a>
									{{ getSyncMailboxLabelPart(1) }}
								</template>
								<template v-else>{{ state.currentMessage.labels.syncError }}</template>
							</div>
							<div
								:id="state.hosts.messageBody.id"
								class="mail-msg-view-body mail-message-view-host"
								:class="getHostStatusClass(state.body.status)"
								:data-testid="state.domContracts.testIds.body"
								:data-message-id="state.currentMessage.id"
								:data-message-body-title="state.hosts.messageBody.title"
								:data-message-body-title-template="state.hosts.messageBody.titleTemplate"
								:data-use-ajax="state.hosts.messageBody.useAjax ? '1' : '0'"
								:data-status="state.body.status"
								:aria-busy="state.body.status === 'loading' ? 'true' : 'false'"
								v-bind="getHostAttribute(state.hosts.messageBody.id)"
							></div>
							<div
								v-if="state.hosts.messageBody.warningWaitId"
								v-show="state.body.status === 'loading'"
								:id="state.hosts.messageBody.warningWaitId"
								class="ui-alert ui-alert-warning mail-message-view-host mail-message-view-warning-host"
								v-bind="getHostAttribute(state.hosts.messageBody.warningWaitId)"
							></div>
							<div
								v-if="state.hosts.messageBody.warningFailId"
								v-show="state.body.status === 'failed'"
								:id="state.hosts.messageBody.warningFailId"
								class="ui-alert ui-alert-default mail-message-view-host mail-message-view-warning-host"
								v-bind="getHostAttribute(state.hosts.messageBody.warningFailId)"
							></div>
						</div>
						<AttachmentsComponent
							v-if="hasAttachmentsHost && attachmentsState && attachmentLabels"
							:state="attachmentsState"
							:labels="attachmentLabels"
							@refresh="handleAttachmentsRefresh"
							@archive="handleAttachmentsIntent"
							@download="handleAttachmentsIntent"
						/>
						<div
							v-else-if="hasAttachmentsHost"
							:id="state.hosts.attachments.id"
							class="mail-msg-view-file-block mail-msg-view-border-bottom mail-message-view-host"
							:class="getHostStatusClass(state.attachments.status)"
							:data-testid="state.domContracts.testIds.attachment"
							:data-status="state.attachments.status"
							:aria-busy="state.attachments.status === 'loading' ? 'true' : 'false'"
							v-bind="getHostAttribute(state.hosts.attachments.id)"
						>
							<div
								class="mail-msg-view-file-inner"
								:id="state.hosts.attachments.ajaxContainerId"
								v-bind="state.hosts.attachments.ajaxContainerId
									? getHostAttribute(state.hosts.attachments.ajaxContainerId)
									: {}"
							></div>
						</div>
						<button
							v-if="hasQuickReplyHost"
							type="button"
							:id="state.hosts.compose.quickReplyButtonId"
							class="mail-msg-view-reply-panel mail-msg-view-border-bottom mail-message-view-host"
							:data-testid="state.domContracts.testIds.quickReply"
							v-bind="state.hosts.compose.quickReplyButtonId
								? getHostAttribute(state.hosts.compose.quickReplyButtonId)
								: {}"
						></button>
						<div
							v-if="state.hosts.compose.enabled"
							:id="state.hosts.compose.formId"
							class="mail-message-view-host mail-message-view-compose-host"
							v-bind="getHostAttribute(state.hosts.compose.formId)"
						></div>
						<div
							v-if="state.hosts.iCal.enabled"
							:id="state.hosts.iCal.id"
							class="mail-message-view-host mail-message-view-ical-host"
							v-bind="getHostAttribute(state.hosts.iCal.id)"
						></div>
					</div>
					<ThreadComponent
						v-if="hasThread"
						:side-state="threadState.after"
						:labels="threadLabels"
						@load-side="handleThreadLoadSide"
						@toggle-item="handleThreadToggleItem"
						@retry-item="handleThreadRetryItem"
					/>
				</div>
			</div>
		</div>
	`,
} satisfies ComponentOptions;
