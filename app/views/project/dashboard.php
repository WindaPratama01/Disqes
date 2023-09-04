<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="flasher-wrap w-100">
                <?php Flasher::flash(); ?>
            </div>
        </div>
    </div>
    <div class="row section-gap">
        <div class="col-12">
            <h4 class="title">Project <?= $data['projects']['name']; ?> ﹥ Dashboard</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Project</h6>
                    <h5 class="menu-value">1</h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="test-suite-icon"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Test Suites</h6>
                    <h5 class="menu-value"><?= $data['countTestSuite']['total_test_suite']; ?></h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="project-icon"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Test Cases</h6>
                    <h5 class="menu-value"><?= $data['countTestCase']['total_test_case']; ?></h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="test-case-icon"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Priority Not Set</h6>
                    <h5 class="menu-value"><?= $data['countNotSet']['total_test_case_not_set']; ?></h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="not-set-icon"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Priority High</h6>
                    <h5 class="menu-value"><?= $data['countHigh']['total_test_case_high']; ?></h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="high-icon"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Priority Medium</h6>
                    <h5 class="menu-value"><?= $data['countMedium']['total_test_case_medium']; ?></h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="medium-icon"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-menu d-flex justify-content-between">
                <div class="wrapper">
                    <h6 class="menu-title">Priority Low</h6>
                    <h5 class="menu-value"><?= $data['countLow']['total_test_case_low']; ?></h5>
                </div>
                <div class="menu-icon d-flex justify-content-center align-items-center">
                    <div class="low-icon"></div>
                </div>
            </div>
        </div>
    </div>
</div>