export type MessageDirection = 'incoming' | 'outgoing';
export type ThreadSideCode = 'before' | 'after';
export type ExternalHostStatus = 'idle' | 'loading' | 'ready' | 'failed';

export type ScreenViewModel = {
	readonly id: string,
	readonly title: string,
	readonly pageSize: number,
	readonly source: string | null,
	readonly paths: Readonly<{
		ajaxUrl: string,
		messageList: string,
		messageNew: string,
		htmlBodyDownload: string,
	}>,
	readonly analytics: Readonly<{
		source: string,
	}> | null,
};

export type MailAddressViewModel = {
	readonly name: string,
	readonly email: string,
	readonly href: string | null,
	readonly title: string,
	readonly isCurrentUser: boolean,
	readonly avatar: Readonly<{
		image: string | null,
		initials: string,
		color: string | null,
	}>,
};

export type RecipientListViewModel = {
	readonly to: readonly MailAddressViewModel[],
	readonly cc: readonly MailAddressViewModel[],
	readonly bcc: readonly MailAddressViewModel[],
	readonly replyTo: readonly MailAddressViewModel[],
};

export type CurrentMessageViewModel = {
	readonly id: number,
	readonly mailboxId: number,
	readonly uidKey: string,
	readonly subject: string,
	readonly sendError: string | null,
	readonly direction: MessageDirection,
	readonly sender: MailAddressViewModel,
	readonly recipients: RecipientListViewModel,
	readonly labels: Readonly<{
		sender: string,
		to: string,
		cc: string,
		bcc: string,
		moreRecipients: string,
		syncError: string,
		syncMailbox: string,
	}>,
	readonly date: Readonly<{
		timestamp: number,
		formatted: string,
		readConfirmedFormatted: string | null,
	}>,
	readonly flags: Readonly<{
		isSpam: boolean,
		isTrash: boolean,
		isSyncError: boolean,
		isTrackable: boolean,
		hideMailControlPanel: boolean,
		hideFastReplyPanel: boolean,
	}>,
	readonly mailbox: Readonly<{
		uri: string,
		host: string,
	}> | null,
};

export type ThreadSideViewModel = {
	readonly code: ThreadSideCode,
	readonly hasMore: boolean,
	readonly loadedCount: number,
};

export type ThreadBootstrapViewModel = {
	readonly currentMessageId: number,
	readonly pageSize: number,
	readonly before: ThreadSideViewModel,
	readonly after: ThreadSideViewModel,
};

export type ExistingActionMap = {
	readonly reply: boolean,
	readonly replyAll: boolean,
	readonly forward: boolean,
	readonly more: boolean,
	readonly discussInChat: boolean,
	readonly assignLabels: boolean,
	readonly unbind: boolean,
	readonly markSpam: boolean,
	readonly delete: boolean,
	readonly quickReply: boolean,
	readonly refreshAttachments: boolean,
	readonly downloadHtmlBody: boolean,
	readonly pageSwapper: boolean,
	readonly iCal: boolean,
};

export type HostViewModel = {
	readonly id: string,
	readonly enabled: boolean,
};

export type MessageBodyHostViewModel = HostViewModel & {
	readonly useAjax: boolean,
	readonly loaderId: string | null,
	readonly warningWaitId: string | null,
	readonly warningFailId: string | null,
	readonly title: string,
	readonly titleTemplate: string,
	readonly loaderMaxTime: number,
};

export type AttachmentsHostViewModel = HostViewModel & {
	readonly ajaxContainerId: string | null,
	readonly refreshButtonId: string | null,
	readonly hasDeferredContent: boolean,
};

export type ComposeHostViewModel = HostViewModel & {
	readonly formId: string,
	readonly quickReplyButtonId: string | null,
	readonly quoteFieldName: string,
};

export type ExternalHostsViewModel = {
	readonly messageBody: MessageBodyHostViewModel,
	readonly attachments: AttachmentsHostViewModel,
	readonly actions: HostViewModel,
	readonly labels: HostViewModel,
	readonly compose: ComposeHostViewModel,
	readonly pageSwapper: HostViewModel,
	readonly iCal: HostViewModel,
};

export type ExistingDomContractViewModel = {
	readonly messageUidKey: string,
	readonly ids: Readonly<{
		pageTitle: string,
		root: string,
		currentDetails: string,
		body: string,
		navigation: string,
		actions: string,
		quickReply: string,
	}>,
	readonly testIds: Readonly<{
		header: string,
		title: string,
		navigation: string,
		scrollArea: string,
		root: string,
		senderName: string,
		senderEmail: string,
		recipient: string,
		recipientEmail: string,
		body: string,
		attachment: string,
		quickReply: string,
	}>,
};

export type BootstrapViewModel = {
	readonly screen: ScreenViewModel,
	readonly currentMessage: CurrentMessageViewModel,
	readonly thread: ThreadBootstrapViewModel,
	readonly capabilities: ExistingActionMap,
	readonly hosts: ExternalHostsViewModel,
	readonly domContracts: ExistingDomContractViewModel,
};

type Mutable<T> = T extends readonly (infer Item)[]
	? Mutable<Item>[]
	: T extends object
		? { -readonly [Property in keyof T]: Mutable<T[Property]> }
		: T;

export type MessageViewState = Mutable<BootstrapViewModel> & {
	body: {
		status: ExternalHostStatus,
		error: string | null,
	},
	attachments: {
		status: ExternalHostStatus,
		error: string | null,
	},
};
