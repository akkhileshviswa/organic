function add_row()
{
    var $rowno = $("#product tr").length;
    $rowno = $rowno+1;
    $("#product tr:last").after("<tr id='row"+$rowno+"'><td class='right'><input type='text' name='name[]' placeholder='Enter Product Name'></td><td class='right'><input type='text' name='quantity[]' placeholder='Enter Quantity'></td><td class='right'><input type='text' name='code[]' placeholder='Enter Product Code'></td><td><input type='button' value='DELETE' id='remove' onclick=delete_row('row"+$rowno+"')></td></tr>");
}
function delete_row(rowno)
{
    $('#'+rowno).remove();
}