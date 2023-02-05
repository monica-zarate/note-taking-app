// We are making use of jQuery's validate function, to create basic validation on the client-side of the application. In this case, we're making sure that the name of a new note is at least 4 characters long. The user won't be able to submit the note form unless this criteria is met. These types of validations help reduce the users frustration by having to re-fill the entire form they're trying to submit, in case there are any errors in one of the fields.

$(function () {
  $("#create_note").validate({
    errorClass: "text-red-500",
    rules: {
      name: {
        required: true,
        minlength: 4,
      },
      message: {
        name: "Please enter a name that is at least 4 characters",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
