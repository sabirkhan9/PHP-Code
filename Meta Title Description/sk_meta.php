<?include("iconnect.php")?>
<?
$pname="sk_meta"; $pnamesub="";
$youarein1=""; $youarein1link="";
$youarein2=""; $youarein2link="";
$youarein3=""; $youarein3link="";
$youarein4=""; $youarein4link="";
$youarein5=""; $youarein5link="";
$youarein6=""; $youarein6link=""; 
$youarein7=""; $youarein7link="";
$youarein8=""; $youarein8link="";
$youareinname="Product Type";
$mainheading="Product Type";
$linkheading="Product Type";
$subheading="";
$bodyheading="List of all Product Type";
$mainheadingdesc="";
$addicon="Yes"; $pdficon="No"; $excelicon="No"; $modifyicon="Yes"; $modifytopicon="No"; $deleteicon="Yes";$priorityicon="Yes";
$linkname="sk_meta";
$linknamepriority="prioritysk_meta";
$linkquery1="";$linkquery2="";$linkquery3="";$linkquery4="";$linkquery5="";$linkquery6="";
$dropdown="sk_meta";
$dropdown1="sk_meta";
$dropdown2=""; $dropdown3=""; $dropdown4=""; $dropdown4=""; $dropdown5=""; $dropdown6=""; $dropdown7="";
?>
<?include ("itophead.php")?> 
<?include ("isubheading.php")?>  
<?include ("iaction.php")?> 
    <div class="container mt-4 ">
        <div class="row">           
            <div class="bd-example">
                 <h2 class="h4 text-center mb-3">Existing Titles and Descriptions</h2>
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">URL</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Edit/Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include("sk_get_data.php"); ?>
                        <?php for ($i = 0; $i < count($rows); $i++) { ?>
                            <tr>
                                <td><?= $rows[$i]['id']; ?></td>
                                <td><?= $rows[$i]['slug']; ?></td>
                                 <td><?= $rows[$i]['meta_title']; ?></td>
                                  <td><?= $rows[$i]['meta_description']; ?></td>
                                <td><a href="sk_edit.php?id=<?= $rows[$i]['id']; ?>" class="btn btn-success">Edit</a></td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>

                </table>
            </div>
        </div>


        <div class="row mt-4 pt-4">           
            <div class="bd-example">
                <h2 class="h4 text-center mb-3">New Add Titles and Descriptions</h2>
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr>
                            <th scope="col">URL</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Add</th>
                        </tr>
                    </thead>
                    <form action="/admin/sk_insert.php" method="post">
                        <tbody>
                            <tr>
                                <td><input type="text" name="slug" id="slug" required class="form-control"> </td>
                                <td><input type="text" name="meta_title" id="meta_title" required class="form-control"> </td>
                                <td><input type="text" name="meta_description" id="meta_description" required class="form-control"> </td>
                                <td><button type="submit" name="add_meta" class="btn btn-success">Add</button></td>
                            </tr>
                        </tbody>
                    </form>

                </table>
            </div>
        </div>

    </div>
 
<!-------------------------------- BASIC MODAL sk_meta Image ENDS-------------------------------->

   <!----tbody ends---->
  </tbody> 
 </table>
</div>	

<?include ("isubheadingempty.php")?>
<?include ("inodata.php")?>

<?include ("ibottom.php")?>