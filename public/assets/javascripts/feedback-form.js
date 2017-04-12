function FeedbackForm($el) {
  var self   = this;
  this.$el   = $el;
  this.$form = $el.find('form');

  this.$form.on('submit', function() {
    self.submit();
    return false;
  });
}

FeedbackForm.prototype.serialize = function() {
  var ary  = this.$form.serializeArray();
  var data = {};

  for (var i = 0, l = ary.length; i < l; ++i) {
    data[ary[i].name] = ary[i].value;
  }

  return data;
};

FeedbackForm.prototype.setErrors = function(errors) {
  var attribute;
  for (attribute in errors) {
    this.$el.find('.js-feedback-form-error-outlet.for-' + attribute).html(
      $('<div/>').addClass('feedback-form-error').text(errors[attribute])
    )
  }
};

FeedbackForm.prototype.removeErrors = function() {
  this.$el.find('.js-feedback-form-error-outlet').empty();
};

FeedbackForm.prototype.submit = function() {
  if ( this.jqXHR ) { return }

  this.removeErrors();

  var self = this;

  var jqXHR = this.jqXHR = $.ajax(this.$form.prop('action'), {
    data:        JSON.stringify(this.serialize()),
    contentType: 'application/json',
    type:        'POST'
  });

  this.$el.find('.js-show-if-feedback-form-progress').removeClass('hide');
  this.$el.find('.js-hide-if-feedback-form-progress').addClass('hide');

  this.jqXHR.done(function() {
    self.$el.find('.js-show-if-feedback-form-success').removeClass('hide');
    self.$el.find('.js-hide-if-feedback-form-success').addClass('hide');
  });

  this.jqXHR.fail(function() {
    if (jqXHR.status === 422) {
      self.setErrors(jqXHR.responseJSON || {});
    } else {
      self.$el.find('.js-show-if-feedback-form-failure').removeClass('hide');
      self.$el.find('.js-hide-if-feedback-form-failure').addClass('hide');
    }
  });

  this.jqXHR.always(function() {
    self.jqXHR = null;
    self.$el.find('.js-show-if-feedback-form-progress').addClass('hide');
    self.$el.find('.js-hide-if-feedback-form-progress').removeClass('hide');
  });
};

$(function() {
  $('.js-feedback-form').each(function() { new FeedbackForm($(this)) });
});