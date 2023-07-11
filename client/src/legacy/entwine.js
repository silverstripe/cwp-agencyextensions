// eslint-disable-next-line import/no-unresolved
import jQuery from 'jquery';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { loadComponent } from 'lib/Injector';

jQuery.entwine('ss', ($) => {
  $('.js-injector-boot .form__field-holder .color-picker-field').entwine({
    ReactRoot: null,

    onmatch() {
      const ColorPickerComponent = loadComponent('ColorPickerField');
      const schemaData = this.data('schema');

      const props = {
        colors: schemaData.source,
        value: schemaData.value,
        name: schemaData.name,
      };

      let root = this.getReactRoot();
      if (!root) {
        root = createRoot(this[0]);
        this.setReactRoot(root);
      }
      root.render(<ColorPickerComponent {...props} />,);
    },

    onunmatch() {
      const root = this.getReactRoot();
      if (root) {
        root.unmount();
        this.setReactRoot(null);
      }
    }
  });

  $('.js-injector-boot .form__field-holder .font-picker-field').entwine({
    ReactRoot: null,

    onmatch() {
      const FontPickerComponent = loadComponent('FontPickerField');
      const schemaData = this.data('schema');

      const props = {
        fonts: schemaData.source,
        value: schemaData.value,
        name: schemaData.name,
      };

      let root = this.getReactRoot();
      if (!root) {
        root = createRoot(this[0]);
        this.setReactRoot(root);
      }
      root.render(<FontPickerComponent {...props} />);
    },

    onunmatch() {
      const root = this.getReactRoot();
      if (root) {
        root.unmount();
        this.setReactRoot(null);
      }
    }
  });
});
