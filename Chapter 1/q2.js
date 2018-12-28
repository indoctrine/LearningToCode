$(document).ready(() => {
  $('form').on('submit', event => {
    event.preventDefault();
    const hours = $('[name="hour"]').val();
    const minutes = $('[name="minute"]').val();
    const seconds = $('[name="second"]').val();

    $.post(
        'q2.php',
        {
          'submit': true,
          'hour': hours,
          'minute': minutes,
          'second': seconds
        },
        response => {
            $('#output').html(response);
        }
    );
  });
});
