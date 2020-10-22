
                        <!-- Main charts -->
                        <!-- /main charts -->
                        <!-- Dashboard content -->
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $this->load->view('limitless/not_visible/statistic_not_used');?>
                                    <?php $this->load->view('limitless/not_visible/report1');?>
                                </div>
                                <!-- /marketing campaigns -->


                                <!-- Quick stats boxes -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="panel bg-blue-400">
                                            <div class="container-fluid">
                                                <div id="members-online"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="panel bg-pink-400">
                                            <div id="server-load"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="panel bg-teal-400">
                                            <div id="today-revenue"></div>
                                        </div></div>
                                </div>
                                <?php $this->load->view('limitless/not_visible/report2');?>
                            </div>

                            <div class="col-lg-4">

                                <!-- Progress counters -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel text-center">
                                            <div class="panel-body">
                                                <div class="content-group-sm svg-center position-relative" id="hours-available-progress"></div>
                                                <div id="hours-available-bars"></div></div>
                                        </div></div>

                                    <div class="col-md-6">
                                        <div class="panel text-center">
                                            <div class="panel-body">
                                                <div class="content-group-sm svg-center position-relative" id="goal-progress"></div>
                                                <div id="goal-bars"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $this->load->view('limitless/not_visible/report3');?>
                            </div>