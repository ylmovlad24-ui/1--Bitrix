import { Text2Xl } from 'ui.system.typography.vue';
import { defineComponent } from 'ui.vue3';

import { Phrase } from '../../const';
import { loc } from '../../lib/loc/loc';

import './subject-generation-text.css';

/**
 * The waiting look of the subject generation, the one the mobile form draws in
 * `mailmobile/install/mobileapp/mailmobile/extensions/mail/sending-form/src/subject-generation-view.js`:
 * the phrase in the BitrixGPT gradient, glowing softly, in a single line. The wait is shown by the gradient
 * sweeping along the phrase; the mobile row dims the text instead, which is not open to us here, because
 * these colours reach 3:1 on the white of the field and a dimmed phrase falls out of it.
 *
 * The animated loader of the mobile row has no twin here: the control that started the generation draws
 * the wait itself. The phrase is a look and nothing else, so a screen reader hears the start of the
 * generation from the announcement of the scenario and not from this node.
 *
 * The gradient fills the glyphs with colours meant for a background, so the phrase reaches 3:1 against the
 * white of the field and no more. `Text2Xl` carries the 19px of the smallest typography over the 18.66px
 * WCAG 1.4.3 calls large scale, and the CSS adds the bold weight the same rule asks for, which puts the
 * phrase under the 3:1 threshold instead of the 4.5:1 one.
 */
// @vue/component
export const SubjectGenerationText = defineComponent({
	name: 'MailComposeSubjectGenerationText',

	components: {
		Text2Xl,
	},

	computed: {
		text(): string
		{
			return loc(Phrase.SubjectGenerationRunning);
		},
	},

	template: `
		<Text2Xl
			class-name="mail-compose-subject-generation-text"
			wrap="truncate"
			data-testid="mail-compose-subject-generation-text"
		>{{ text }}</Text2Xl>
	`,
});
