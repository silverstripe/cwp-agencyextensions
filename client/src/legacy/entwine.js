import jQuery from 'jquery';
import React from 'react';
import ReactDOM from 'react-dom';
import { loadComponent } from 'lib/Injector';

jQuery.entwine('ss', ($) => {
  $('.js-injector-boot .form__field-holder .color-picker-field').entwine({
    onmatch() {
      const ColorPickerComponent = loadComponent('ColorPickerField');
      const schemaData = this.data('schema');

      const props = {
        colors: schemaData.source,
        value: schemaData.value,
        name: schemaData.name,
      };

      ReactDOM.render(
        <ColorPickerComponent {...props} />,
        this[0]
      );
    },

    onunmatch() {
      ReactDOM.unmountComponentAtNode(this[0]);
    }
  });

  $('.js-injector-boot .form__field-holder .font-picker-field').entwine({
    onmatch() {
      const FontPickerComponent = loadComponent('FontPickerField');
      const schemaData = this.data('schema');

      const props = {
        fonts: schemaData.source,
        value: schemaData.value,
        name: schemaData.name,
      };

      ReactDOM.render(
        <FontPickerComponent {...props} />,
        this[0]
      );
    },

    onunmatch() {
      ReactDOM.unmountComponentAtNode(this[0]);
    }
  });
});
