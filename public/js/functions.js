$(document).ready(function()
{
      $('#teste').click(function() {
            var path = $('#teste').attr('href');
            $('#retorno').load(path);
            return false;
      });
});