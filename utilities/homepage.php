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
        <div class="row">
            <div class="col-xl-10 mx-auto table-responsive">
                <table class="table table-borderless align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="border-0">
                            <th class="p-0"></th>
                            <th class="p-0 text-center"></th>
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

                                    <div class="text-center fs-20">No data found! Click <a href="./admin?v=new">here</a> to add a new TimeTable</div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <?php } else {
                            while ($row = mysqli_fetch_assoc($res)) :
                            ?>
                                <tr class="lift" style="cursor: pointer;" key="<?php echo $row['table_key']; ?>">
                                    <td onclick="window.location.href='<?php echo './' . $row['table_key']; ?>'">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-45px me-5">
                                                <span class="avatar <?php echo $App->randomize_bg() ?> text-white w-9 h-9 fs-17 me-3"><?php echo strtok($row['class'], ' '); ?></span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="./<?php echo $row['table_key']; ?>" class="text-dark fw-bolder text-hover-primary mb-1 fs-16"><?php echo $row['class'] ?></a>
                                                <!--end::Name-->
                                            </div>
                                    </td>
                                    <td onclick="window.location.href='<?php echo './' . $row['table_key']; ?>'" class="text-center"><?php echo $row['class_incharge'] ?></td>
                                    <td class="text-end">
                                        <wxp-share></wxp-share>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        } ?>
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->