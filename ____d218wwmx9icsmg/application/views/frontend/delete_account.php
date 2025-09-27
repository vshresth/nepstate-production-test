<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>
<?php include("common/siderbar.php"); ?>
<style>

.container1 {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 50%;
    height: 50%;
    padding:20px;
    padding-right: 10px;
    padding-left: 10px;
    margin-right: auto;
    margin-left: auto; 
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}


input {
    width: calc(100% - 20px);
    padding: 16px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
}

#deleteBtn{
    margin-top: 10px;
}

</style>
<div class="container1">
        <h1>Delete Your Account</h1>
        <p>Are you sure you want to delete your account? Please type <strong>DELETE</strong> in the box below to confirm.</p>
        <form action="<?php echo base_url(); ?>remove-account" method="POST">
            <input type="text" name="confirmation" placeholder="Type DELETE here" required>
            <div class="form-group text-center" id="deleteBtn">
                <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60">Delete Account</button>
            </div>
        </form>
    </div>
<?php include("common/footer.php"); ?>
