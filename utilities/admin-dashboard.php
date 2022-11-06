<?php include 'header.php' ?>
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row text-center">
            <div class="col-xl-10 mx-auto">
                <h2 class="fs-15 text-uppercase text-muted mb-3">TimeTables</h2>
                <!-- <h3 class="display-4 mb-10 px-xxl-15">We’re always searching for amazing people to join our team. Take a look at our current openings.</h3> -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row align-items-center mb-10">
            <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
                <h3 class="mb-4">Create/Update/Delete a timetable</h3>
            </div>
            <!--/column -->
            <div class="col-md-4 col-lg-3 ms-md-auto text-md-end mt-5 mt-md-0">
                <a href="?v=new" class="btn btn-soft-primary rounded-pill mb-0">Add New</a>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="mb-10">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="border-0">
                                <th class="p-0"></th>
                                <th class="p-0 min-w-100px text-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM data");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $count = $res->num_rows;
                            if ($count === 0) { ?>
                                <div class="card mb-4 alert alert-info">
                                    <div class="card-body p-5">

                                        <div class="text-center fs-20">No data found! Click <a href="?v=new">here</a> to add a new TimeTable</div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <?php } else {
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr key="<?php echo $row['table_key']; ?>">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px me-5">
                                                    <span class="avatar <?php echo $App->randomize_bg() ?> text-white w-9 h-9 fs-17 me-3"><?php echo strtok($row['class'], ' '); ?></span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Name-->
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="./<?php echo $row['table_key']; ?>" target="_blank" rel="noopener noreferrer" class="text-dark fw-bolder text-hover-primary mb-1 fs-16"><?php echo $row['class'] ?></a>
                                                    <!--end::Name-->
                                                </div>
                                        </td>
                                        <td class="text-end">
                                            <a href="?v=edit&key=<?php echo $row['table_key']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="uil uil-edit fs-16" style="color:#000 !important"></i>
                                            </a>
                                            <a href="javascript:;" delete="<?php echo $row['table_key']; ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="uil uil-trash-alt fs-16" style="color:#000 !important"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                endwhile;
                            } ?>

                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<?php
$INIT_SCRIPTS = "admin";
include 'footer.php' ?>