<?php
    $html_response = '';

    $file_content = file('All.csv');
    $start = '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div style="width:700px;border:1px solid black;margin:0 auto;"><input class="input-lg" style="padding:5px;margin:5px;" type="text" id="myInput" onkeyup="get_genes()" placeholder="Search ..." autofocus><i style="font-size:20px;"" class="glyphicon glyphicon-search"></i>
<button>Pipeline I</button>
<button>Pipeline II</button>
</div>
<div style="overflow:auto;width:700px;height:500px;border:1px solid black;margin:0 auto;"><table id="myTable" class="table table-bordered table-condensed">
';

    $to_remove = array("gene_id", "crispr plasmids constructed", "ordered vector primers", "PCR-passing design oligos", "donor vectors constructed", "DNA source vector", "priority");
    $indices_to_remove = array();

    $to_edit = array("gene symbol", "chr", "sponsor(s)");
    $indices_to_edit = array();

    $tick_symbol = "&#10004;";
    $cross_symbol = "&#10005;";

    $header = array_shift($file_content);
    $header_elems = explode(',', $header);

    foreach($to_remove as $col_name) {
        $indx = array_search($col_name, $header_elems);
        array_push($indices_to_remove, $indx);
    }

    foreach($indices_to_remove as $header_indx){
        unset($header_elems[$header_indx]);
    }
    $header_elems = array_values($header_elems);


    foreach($to_edit as $col) {
        $ind = array_search($col, $header_elems);
        array_push($indices_to_edit, $ind);
    }

    $start .= '<thead>';

    foreach ($header_elems as $elem) {
        $start .= '<th class="bg-primary" style="text-align:center;">'.$elem.'</th>';
    }
    $start .= '</thead>';

    foreach($file_content as $row) {
        $html_response .= '<tr>';
        $temp_array = explode(',', $row);

        foreach($indices_to_remove as $temp_indx){
            unset($temp_array[$temp_indx]);
        }
        $temp_array = array_values($temp_array);

        $counter = 0;
        foreach ($temp_array as $cell) {
            if (in_array($counter, $indices_to_edit)){
                $html_response .= '<td class="bg-info" style="text-align:center;">'.$cell.'</td>';
            }
            elseif ($cell) {
                $html_response .= '<td class="bg-info"><span style="color:green;text-align:center;">'.$tick_symbol.'</span></td>';
            } else {
                $html_response .= '<td class="bg-info"><span style="color:red;text-align:center;">'.$cross_symbol.'</span></td>';
            }
            $counter++;
        }
        $html_response .= '</tr>';
    }

    $js_code = '
<script>
function get_genes() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i=0; i<tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display ="";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>

';

    echo $start.$html_response.'</table></div><br/><br />'.$js_code;
  ?>
