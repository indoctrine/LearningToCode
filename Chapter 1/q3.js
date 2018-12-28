$(document).ready(() => {
  $('form').on('submit', event => {
    event.preventDefault();
    const squares = $('[name="squares"]').val();

    $.post(
        'q3.php',
        {
          'submit': true,
          'squares': squares,
        },
        response => {
            $('#output').html(response);
        }
    );
  });
});
