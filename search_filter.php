<?php 
include('../db_connect/conn.php');
if(isset($_POST["query"]))
{
$search = mysqli_real_escape_string($conn, $_POST["query"]);
$query="SELECT * FROM tbl_portfolio WHERE id  LIKE '%".$search."%' OR project_name LIKE '%".$search."%' OR project_link LIKE '%".$search."%'";
}else{
$query="SELECT * FROM tbl_portfolio ORDER BY id DESC";
}
$i=0;
$selectPorjectDetails=$conn->query($query);
while ($fetchPortpolio=$selectPorjectDetails->fetch_assoc()) {
$portfolioId=$fetchPortpolio['id'];
$i++;
?>
	<tr>
		<td><?=$i;?></td>
		<td><?=ucwords($fetchPortpolio['project_name']);?></td>
		<td>
			<?php 
			$selectProjectCategory=$conn->query("SELECT * FROM tbl_multiple_portfolio_category WHERE portfolio_id ='$portfolioId'");
			while ($fetchPortpolioCategory=$selectProjectCategory->fetch_assoc()) {
				$multipleId=$fetchPortpolioCategory['category_id'];
				$selectPortfolioCatName=$conn->query("SELECT * FROM tbl_portfolio_category WHERE id='".$multipleId."'");
				$fetchPortfolioCatName=$selectPortfolioCatName->fetch_assoc();
				echo ucwords($fetchPortfolioCatName['category_name']);
			}
			?>
		</td>
		<td><?=$fetchPortpolio['project_link'];?></td>
		<td><?php if($fetchPortpolio['status']==1){echo "Active";}else{echo "Inactive";}?></td>
		<td><a href="edit_portfolio.php?id=<?=$fetchPortpolio['id'];?>" class="btn btn-info">Edit</a></td>
		<td><a onclick="return deleteConfirmation();" href="delete_portfolio.php?id=<?=$fetchPortpolio['id'];?>"class="btn btn-danger">Delete</a></td>
	</tr>
  <?php }?>
