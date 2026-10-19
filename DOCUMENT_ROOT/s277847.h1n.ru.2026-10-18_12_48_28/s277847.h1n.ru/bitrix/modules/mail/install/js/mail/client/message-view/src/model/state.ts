import { reactive } from 'ui.vue3';

import {
	type AttachmentsHostViewModel,
	type BootstrapViewModel,
	type CurrentMessageViewModel,
	type ExistingDomContractViewModel,
	type ExternalHostsViewModel,
	type MailAddressViewModel,
	type MessageViewState,
	type RecipientListViewModel,
	type ScreenViewModel,
	type ThreadBootstrapViewModel,
} from './types';

export function createMessageViewState(bootstrap: Readonly<BootstrapViewModel>): MessageViewState
{
	return reactive(createMessageViewStateData(bootstrap)) as MessageViewState;
}

export function createMessageViewStateData(bootstrap: Readonly<BootstrapViewModel>): MessageViewState
{
	return {
		screen: cloneScreen(bootstrap.screen),
		currentMessage: cloneCurrentMessage(bootstrap.currentMessage),
		thread: cloneThread(bootstrap.thread),
		capabilities: { ...bootstrap.capabilities },
		hosts: cloneHosts(bootstrap.hosts),
		domContracts: cloneDomContracts(bootstrap.domContracts),
		body: {
			status: bootstrap.hosts.messageBody.useAjax ? 'loading' : 'ready',
			error: null,
		},
		attachments: {
			status: getInitialAttachmentStatus(bootstrap.hosts.attachments),
			error: null,
		},
	};
}

function cloneScreen(screen: ScreenViewModel): MessageViewState['screen']
{
	return {
		...screen,
		paths: { ...screen.paths },
		analytics: screen.analytics ? { ...screen.analytics } : null,
	};
}

function cloneCurrentMessage(message: CurrentMessageViewModel): MessageViewState['currentMessage']
{
	return {
		...message,
		sender: cloneAddress(message.sender),
		recipients: cloneRecipients(message.recipients),
		labels: { ...message.labels },
		date: { ...message.date },
		flags: { ...message.flags },
		mailbox: message.mailbox ? { ...message.mailbox } : null,
	};
}

function cloneAddress(address: MailAddressViewModel): MessageViewState['currentMessage']['sender']
{
	return {
		...address,
		avatar: { ...address.avatar },
	};
}

function cloneRecipients(recipients: RecipientListViewModel): MessageViewState['currentMessage']['recipients']
{
	return {
		to: recipients.to.map((address) => cloneAddress(address)),
		cc: recipients.cc.map((address) => cloneAddress(address)),
		bcc: recipients.bcc.map((address) => cloneAddress(address)),
		replyTo: recipients.replyTo.map((address) => cloneAddress(address)),
	};
}

function cloneThread(thread: ThreadBootstrapViewModel): MessageViewState['thread']
{
	return {
		...thread,
		before: { ...thread.before },
		after: { ...thread.after },
	};
}

function cloneHosts(hosts: ExternalHostsViewModel): MessageViewState['hosts']
{
	return {
		messageBody: { ...hosts.messageBody },
		attachments: { ...hosts.attachments },
		actions: { ...hosts.actions },
		labels: { ...hosts.labels },
		compose: { ...hosts.compose },
		pageSwapper: { ...hosts.pageSwapper },
		iCal: { ...hosts.iCal },
	};
}

function cloneDomContracts(domContracts: ExistingDomContractViewModel): MessageViewState['domContracts']
{
	return {
		messageUidKey: domContracts.messageUidKey,
		ids: { ...domContracts.ids },
		testIds: { ...domContracts.testIds },
	};
}

function getInitialAttachmentStatus(host: AttachmentsHostViewModel): MessageViewState['attachments']['status']
{
	if (!host.enabled)
	{
		return 'idle';
	}

	return host.hasDeferredContent ? 'loading' : 'ready';
}
