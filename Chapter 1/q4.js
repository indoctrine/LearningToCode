$(document).ready(() => {
  $('form').on('submit', event => {
    event.preventDefault();
    const pprice = $('[name="pprice"]').val();
    const tendered = $('[name="tendered"]').val();

    $.post(
        'q4.php',
        {
          'submit': true,
          'pprice': pprice,
          'tendered': tendered
        },
        response => {
            $('#output').html(response);
        }
    );
  });
});
