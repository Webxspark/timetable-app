<?php include 'header.php' ?>
<section class="wrapper bg-light angled upper-end">
    <div class="container py-14 py-md-16">
        <form wxpclid="new-data" method="post" action="<wxp-self>">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                    <p class="lead text-center mb-10">Add a new TimeTable</p>
                    <div class="messages"></div>
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-16 fw-bold mb-2">
                            <span class="required">Class Incharge</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Class Incharge Name" name="classIncharge">
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class="required fs-16 fw-bold mb-2">Year</label>
                            <input type="text" class="form-control form-control-solid" placeholder="1/2/3/4" name="year">
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class="required fs-16 fw-bold mb-2">SEM</label>
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="Current semester" name="sem">
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class="required fs-16 fw-bold mb-2">Class</label>
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="Dept - Section" name="class">
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <div></div>
                    <!-- /form -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row gx-lg-12 gx-xl-16 gy-10 align-items-center">
                <div class="table-responsive">
                    <table style="font-size: 0.72rem;" class="table table-bordered">
                        <tr>
                            <td><b>TIME</b></td>
                            <td><b>8:00-8:50</b></td>
                            <td><b>8:50-09:40</b></td>
                            <td width="20px"></td>
                            <td><b>9:50-10:40</b></td>
                            <td><b>10:40-11:30</b></td>
                            <td><b>11:30-12:20</b></td>
                            <td><b>12:20-1:10</b></td>
                            <td><b>1:10-2:00</b></td>
                            <td><b>2:00-2:50</b></td>
                            <td><b>2:50-3:40</b></td>
                        </tr>
                        <tr>
                            <td><b>MONDAY</b></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td rowspan="6" align="center" height="50">
                                <h2>L<br>U<br>N<br>C<br>H</h2>
                            </td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="monday" placeholder="Code/Sub" /></td>

                        </tr>
                        <tr>
                            <td><b>TUESDAY</b></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="tuesday" placeholder="Code/Sub" /></td>
                        </tr>
                        <tr>
                            <td><b>WEDNESDAY</b></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="wednesday" placeholder="Code/Sub" /></td>
                        </tr>
                        <tr>
                            <td><b>THURSDAY</b></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="thursday" placeholder="Code/Sub" /></td>
                        </tr>
                        <tr>
                            <td><b>FRIDAY</b></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                            <td align="center"><input type="text" class="form-control form-control-solid" name="friday" placeholder="Code/Sub" /></td>
                        </tr>
                    </table>
                </div>


            </div>
            <!--/.row -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary ">Add Data</button>
            </div>
        </form>
    </div>
    <!-- /.container -->
    <div></div>
</section>

<?php
$INIT_SCRIPTS = "new-tt";
include 'footer.php' ?>