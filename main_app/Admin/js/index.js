
function search(){
    var search = $('#first_filter').val();
    var search2 = $('#second_filter').val();
    $.ajax({
      type: 'POST',
      url: 'php/search.php',
      data: {'search': search,'s2':search2},
      beforeSend: function(){
        $('#result').html('<img src="img/pacman.gif">');
      }
    })
    .done(function(resultado){
      $('#result').html(resultado);
    })
    .fail(function(){
      alert('Hubo un error :(');
    });
  }
function get_option(){
    var search = $('#first_filter').val();
    $.ajax({
      type: 'POST',
      url: 'php/ge.php',
      data: {'search': search}
    })
    .done(function(resultado){
      $('#second_filter').html(resultado);
    })
    .fail(function(){
      alert('Hubo un error :(');
    });
  }