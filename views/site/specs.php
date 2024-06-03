<?php

    $this->title = 'Список специалистов';

    $docList = "";

    foreach ($specList as $doc){
        $docList .= '
        <tr class = "tdm" onclick="navto(`tabel?docid='.$doc['docInfo']["id"].'`)" class="trc">
            <th>'.$doc['docInfo']["id"].'</th>
            <td>' . $doc['docInfo']['last_name'] . ' ' . $doc['docInfo']['first_name'] . ' ' . $doc['docInfo']['father_name'] . '</td>
            <td>'.$doc["docSpec"]["title"].'</td>
            <td>'.$doc['docReg']["numeral"].'</td>
            <td style = "font-size: 16px;">'.$doc['polInfo']["title"].'<br>'.$doc['polInfo']["address"].'</td>
        </tr>';
    }


?>

<style>
    .tdm > th,
    .tdm > td,{
        cursor: pointer!important;
        transition: .35s!important;
    }

    .tdm:hover > th,
    .tdm:hover > td {
        background-color: rgba(0,0,0,.1) !important;
        transition: .35s!important;
    }
</style>

<h1>Список специалистов</h1>
<h7>Поликлиника закрепления: NAME</h7>

<table class="table" style = 'margin-top: 50px'>
    <thead>
    <tr>
        <th scope="col">ИД</th>
        <th scope="col">Специалист</th>
        <th scope="col">Специальность</th>
        <th scope="col">Участок</th>
        <th scope="col">Поликлиника</th>
    </tr>
    </thead>
    <tbody>
        <?php echo $docList ?>
    </tbody>
</table>

<script>
    function navto(url){
        let readyUrl = window.location.href;
        let urlSplit = window.location.href.split('/');
        readyUrl = readyUrl.replace(urlSplit.at(-1), url);

        window.location.href = readyUrl;
    }
</script>
