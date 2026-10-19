import { MessageViewScreenApplication, type MessageViewOptions } from './app';
import { messageViewFacade, Screen } from './screen';

export class MessageView
{
	#options: MessageViewOptions;
	#screen: Screen | null = null;

	constructor(options: MessageViewOptions)
	{
		this.#options = options;
	}

	static getScreen(messageId?: number | string): Screen | undefined
	{
		return messageViewFacade.getView(messageId);
	}

	start(): void
	{
		if (this.#screen?.isAlive())
		{
			return;
		}

		messageViewFacade.current()?.destroy();
		const application = new MessageViewScreenApplication(this.#options);
		const screen = new Screen({
			messageId: this.#options.bootstrap.currentMessage.id,
			mailboxId: this.#options.bootstrap.currentMessage.mailboxId,
			application,
		});
		application.bindScreen(screen);
		this.#screen = screen;
		screen.registerCleanup(() => {
			if (this.#screen === screen)
			{
				this.#screen = null;
			}
		});
		screen.start();
	}

	destroy(): void
	{
		const screen = this.#screen;
		this.#screen = null;
		screen?.destroy();
	}
}
