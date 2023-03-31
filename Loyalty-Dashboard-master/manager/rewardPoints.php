<?php
include('./includes/header.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <?php include('includes/aside.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="text-uppercase m-2">Reward Points</h1>
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Main row -->

                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12">
                            <!-- Custom tabs (Charts with tabs)-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Reward points rate</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <h4>Today's reward rate is coins <strong>200</strong></h4>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- /.card -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Reward points</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="#"
                                                method="POST">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label>Select Country code</label>
                                                        <select class="custom-select form-control-border"
                                                            name="countryCode"
                                                            id="countryCode">
                                                            <option value="">Select country code</option>
                                                            <option value="250">250 Rwanda</option>
                                                            <option value="251">251 Ethiopia</option>
                                                            <option value="254">254 Kenya</option>
                                                            <option value="255">255 Tanzania</option>
                                                            <option value="256">256 Uganda</option>
                                                            <option value="257">257 Burundi</option>
                                                            <option value="260">260 Zambia</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="Phonenumber">Customer
                                                                Phonenumber(700100100)</label>
                                                            <input type="text"
                                                                class="form-control"
                                                                name="phonenumber"
                                                                id="Phonenumber"
                                                                placeholder="700100100">

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="totalpurchase">Total Purchase</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="totalPurchase"
                                                        id="totalpurchase"
                                                        placeholder="Total Purchase of Goods">
                                                </div>

                                                <button type="submit"
                                                    name="rewardPoints"
                                                    class="btn btn-outline-primary btn-lg text-uppercase w-100">Reward
                                                    Points</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->





                    </div>
                    <!-- /.row (main row) -->


                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include('./includes/footer.php');
        ?>