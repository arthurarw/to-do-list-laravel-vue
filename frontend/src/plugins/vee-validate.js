import {extend} from 'vee-validate';
import {required, email, regex} from 'vee-validate/dist/rules';
import {messages as messagePt} from 'vee-validate/dist/locale/pt_BR';

extend('required', {
    ...required,
    message: messagePt.required,
});

extend('email', {
    ...email,
    message: messagePt.email,
});

extend('regex', {
    ...regex,
    message: messagePt.regex,
});