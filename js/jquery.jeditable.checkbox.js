$.editable.addInputType('checkbox', {
  element: function(settings, original) {
    $(this).append('<input type="checkbox"/>');
    var hidden = $('<input type="hidden"/>');
    $(this).append(hidden);
    return(hidden);
  },

  submit: function(settings, original) {
    settings = $.extend({ checkbox: {
      trueValue: '1',
      falseValue: '0'
    }}, settings);

    if ($(':checkbox', this).is(':checked')) {
      $(':hidden', this).val(settings.checkbox.trueValue);
    } else {
      $(':hidden', this).val(settings.checkbox.falseValue);
    }
  },

  content: function(data, settings, original) {
    settings = $.extend({ checkbox: {
      trueValue: '1',
      falseValue: '0'
    }}, settings);

    if (data == settings.checkbox.trueValue) {
      $(':checkbox', this).attr('checked', 'checked');
    } else {
      $(':checkbox', this).removeAttr('checked');
    }
  }
});

