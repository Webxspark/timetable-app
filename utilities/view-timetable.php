<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row">
            <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                <h2 class="fs-16 text-uppercase text-primary mb-3">TimeTable of <?php echo $DATA['class'] ?></h2>
            </div>
            <!-- /column -->
        </div>
        <style>
            @media (min-width:1400px) {
                .container,
                .container-lg,
                .container-md,
                .container-sm,
                .container-xl,
                .container-xxl {
                    max-width: 1429px !important;
                }
            }
        </style>
        <div class="row gx-lg-12 gx-xl-16 gy-10 align-items-center">
            <div class="table-responsive">
                <table style="font-size: 0.7rem;" class="table table-bordered">
                    <caption class="text-center fw-bold fs-16 text-info">YEAR/SEM/SEC: <?php echo "{$DATA['year']}/{$DATA['sem']}/{$DATA['class']}" ?></caption>
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
                        <td name="monday" period="1" align="center">loading...</td>
                        <td name="monday" period="2" align="center">loading...</td>
                        <td></td>
                        <td name="monday" period="3" align="center">loading...</td>
                        <td name="monday" period="4" align="center">loading...</td>
                        <td rowspan="6" align="center" height="50">
                            <h2>L<br>U<br>N<br>C<br>H</h2>
                        </td>
                        <td name="monday" period="5" align="center">loading...</td>
                        <td name="monday" period="6" align="center">loading...</td>
                        <td name="monday" period="7" align="center">loading...</td>
                        <td name="monday" period="8" align="center">loading...</td>
                    </tr>
                    <tr>
                        <td><b>TUESDAY</b></td>
                        <td name="tuesday" period="1" align="center">loading...</td>
                        <td name="tuesday" period="2" align="center">loading...</td>
                        <td></td>
                        <td name="tuesday" period="3" align="center">loading...</td>
                        <td name="tuesday" period="4" align="center">loading...</td>
                        <td name="tuesday" period="5" align="center">loading...</td>
                        <td name="tuesday" period="6" align="center">loading...</td>
                        <td name="tuesday" period="7" align="center">loading...</td>
                        <td name="tuesday" period="8" align="center">loading...</td>
                    </tr>
                    <tr>
                        <td><b>WEDNESDAY</b></td>
                        <td name="wednesday" period="1" align="center">loading...</td>
                        <td name="wednesday" period="2" align="center">loading...</td>
                        <td></td>
                        <td name="wednesday" period="3" align="center">loading...</td>
                        <td name="wednesday" period="4" align="center">loading...</td>
                        <td name="wednesday" period="5" align="center">loading...</td>
                        <td name="wednesday" period="6" align="center">loading...</td>
                        <td name="wednesday" period="7" align="center">loading...</td>
                        <td name="wednesday" period="8" align="center">loading...</td>
                    </tr>
                    <tr>
                        <td><b>THURSDAY</b></td>
                        <td name="thursday" period="1" align="center">loading...</td>
                        <td name="thursday" period="2" align="center">loading...</td>
                        <td></td>
                        <td name="thursday" period="3" align="center">loading...</td>
                        <td name="thursday" period="4" align="center">loading...</td>
                        <td name="thursday" period="5" align="center">loading...</td>
                        <td name="thursday" period="6" align="center">loading...</td>
                        <td name="thursday" period="7" align="center">loading...</td>
                        <td name="thursday" period="8" align="center">loading...</td>
                    </tr>
                    <tr>
                        <td><b>FRIDAY</b></td>
                        <td name="friday" period="1" align="center">loading...</td>
                        <td name="friday" period="2" align="center">loading...</td>
                        <td></td>
                        <td name="friday" period="3" align="center">loading...</td>
                        <td name="friday" period="4" align="center">loading...</td>
                        <td name="friday" period="5" align="center">loading...</td>
                        <td name="friday" period="6" align="center">loading...</td>
                        <td name="friday" period="7" align="center">loading...</td>
                        <td name="friday" period="8" align="center">loading...</td>
                    </tr>
                </table>
            </div>


        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>
<dom-if style="display: none;" table-key="<?php echo $DATA['table_key']; ?>" />
<?php $INIT_SCRIPTS = "viewer"; ?>