import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
  static values = {formToShow: String};

  toggleForm(event) {
    event.preventDefault();
    const forms = ['loginForm', 'registerForm', 'forgotPasswordForm'];

    console.log('formToShowValue: ' + this.formToShowValue);
    forms.forEach(form => {
      console.log(form);
      const element = document.getElementById(form);
      if (form === this.formToShowValue) {
        element.classList.remove('hidden');
      } else {
        element.classList.add('hidden');
      }
    });
  }
}
