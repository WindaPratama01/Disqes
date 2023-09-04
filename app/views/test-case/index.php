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
            <h4 class="title">Test Cases</h4>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-bar">
                <div class="filter-button d-flex justify-content-between align-items-center">
                    <div class="wrapper d-flex align-items-center gap-2">
                        <div class="filter-icon"></div>
                        <p>Search</p>
                        <?php if ($_GET['url'] == 'testcase/filterTestCase') : ?>
                            | <p class="filter-searching"><?= $data['filterName']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="arrow-icon"></div>
                </div>
                <div class="filter-content">
                    <form action="<?= BASEURL; ?>testcase/filterTestCase" method="POST" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="project_id" value="<?= $_SESSION['project']; ?>">
                        <div class="row">
                            <div class="col-12 mt-4 mt-md-0">
                                <div class="input-wrapper w-100 position-relative">
                                    <p class="caption-input">Name <span class="input-required">*</span></p>
                                    <input type="text" class="input position-relative" id="nameInput" name="name" autocomplete="off" required value="">
                                </div>
                            </div>
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="search-icon"></div>
                                Search
                            </button>
                            <button type="button" class="reset-button button-transparent d-flex align-items-center">
                                <div class="reset-icon"></div>
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <?php if ($_GET['url'] == 'testcase' || $_GET['url'] == 'testcase/filterTestCase') : ?>
    <?php endif; ?> -->

    <div class="row">
        <div class="col-12 col-lg-3 mb-4 mb-lg-0">
            <div class="table-header d-flex justify-content-between align-items-center">
                <p class="table-title">Test Suites</p>
                <div class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#addNewSuite">
                    <div class="add-suite-icon"></div>
                </div>
            </div>
            <a href="<?= BASEURL; ?>testcase" class="suite-header d-flex align-items-center">
                <div class="all-suite-icon"></div>
                <p>All Test Cases</p>
            </a>
            <ul class="list-move-suite">
                <?php foreach ($data['test_suites'] as $i => $test_suite) : ?>
                    <li>
                        <div class="wrapper-suite">
                            <div class="wrapper-header position-relative">
                                <a href="<?= BASEURL; ?>testcase/testsuite/<?= $test_suite['id']; ?>" class="suite-header d-flex align-items-center justify-content-between position-relative <?= $_GET['url'] == 'testcase/testsuite/' . $test_suite['id'] ? 'active' : '' ?>">
                                    <div class="wrapper-header d-flex align-items-center">
                                        <div class="suite-icon"></div>
                                        <p><?= $test_suite['name']; ?></p>
                                    </div>
                                    <!-- <div class="arrow-suite p-1 pe-0 <?= $_GET['url'] == 'testcase/testsuite/' . $test_suite['id'] ? 'active' : '' ?> <?= $_GET['url'] == 'testcase/testsection/' . $test_suite['id'] . '/' . $test_section['id'] ? 'active-bg' : '' ?>"> -->
                                    <div class="arrow-suite p-1 pe-0 <?= $_GET['url'] == 'testcase/testsuite/' . $test_suite['id'] ? 'active' : '' ?>">
                                        <div class="arrow-icon"></div>
                                    </div>
                                </a>
                                <div class="wrapper-action action-suite d-flex align-items-center">
                                    <div class="box-rotate position-relative"></div>
                                    <div class="card-action d-flex position-relative">
                                        <button type="button" class="wrapper-icon" onclick="upMoveSuite()">
                                            <div class="up-icon"></div>
                                        </button>
                                        <button type="button" class="wrapper-icon" onclick="downMoveSuite()">
                                            <div class="down-icon"></div>
                                        </button>
                                        <button type="button" class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#addNewSection" data-id="<?= $test_suite['id']; ?>">
                                            <div class="add-section-icon"></div>
                                        </button>
                                        <button type="button" class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#editSuite" data-id="<?= $test_suite['id']; ?>">
                                            <div class="edit-icon"></div>
                                        </button>
                                        <button type="button" class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#deleteSuite" data-id="<?= $test_suite['id']; ?>">
                                            <div class="delete-icon"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-move-section">
                                <?php foreach ($data['test_sections'] as $test_section) : ?>
                                    <?php if ($test_suite['id'] == $test_section['test_suite_id']) : ?>
                                        <li>
                                            <div class="suite-menu position-relative active <?= $_GET['url'] == 'testcase/testsuite/' . $test_suite['id'] || $_GET['url'] == 'testcase/testsection/' . $test_suite['id'] . '/' . $test_section['id'] ? 'active' : '' ?> <?= $_GET['url'] == 'testcase/testsection/' . $test_suite['id'] . '/' . $test_section['id'] ? 'active-bg' : '' ?>">
                                                <a href="<?= BASEURL; ?>testcase/testsection/<?= $test_suite['id']; ?>/<?= $test_section['id']; ?>" class="position-relative"><?= $test_section['name']; ?></a>
                                                <div class="wrapper-action action-section d-flex align-items-center">
                                                    <div class="box-rotate position-relative"></div>
                                                    <div class="card-action d-flex position-relative">
                                                        <button type="button" class="wrapper-icon" onclick="upMoveSection()">
                                                            <div class="up-icon"></div>
                                                        </button>
                                                        <button type="button" class="wrapper-icon" onclick="downMoveSection()">
                                                            <div class="down-icon"></div>
                                                        </button>
                                                        <button type="button" class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#editSection" data-id="<?= $test_section['id']; ?>">
                                                            <div class="edit-icon"></div>
                                                        </button>
                                                        <button type="button" class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#deleteSection" data-id="<?= $test_section['id']; ?>">
                                                            <div class="delete-icon"></div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="wrapper-close"></div>
        </div>

        <div class="col col-case">
            <div class="table-header d-flex justify-content-between align-items-center">
                <p class="table-title"><?= $data['title_case']; ?></p>
                <!-- <?php if ($data['url_add_case'] == true) : ?>
                    <a href="<?= BASEURL; ?>testcase/addTestCase/<?= $data['url_add_case']; ?>" class="button-primary d-flex align-items-center">
                        <div class="add-icon"></div>New
                    </a>
                    <?php endif; ?> -->
                <a href="<?= BASEURL; ?>testcase/addTestCase" class="button-primary d-flex align-items-center">
                    <div class="add-icon"></div>New
                </a>
            </div>
            <div class="case-header">
                <div class="row">
                    <div class="col-10">
                        <p>Name</p>
                    </div>
                    <div class="col-2">
                        <p>Key</p>
                    </div>
                </div>
            </div>

            <ul class="list-move-case">
                <?php if ($data['test_cases']) : ?>
                    <?php foreach ($data['test_cases'] as $test_case) : ?>
                        <li>
                            <div class="case-menu position-relative">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="wrapper d-flex align-items-center gap-2">
                                            <p><?= $test_case['test_section_name']; ?></p> |
                                            <p><?= $test_case['name']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <p><?= $test_case['key_case']; ?></p>
                                    </div>
                                </div>
                                <div class="wrapper-action action-case d-flex align-items-center">
                                    <div class="box-rotate position-relative"></div>
                                    <div class="card-action d-flex position-relative">
                                        <button type="button" class="wrapper-icon" onclick="upMoveCase()">
                                            <div class="up-icon"></div>
                                        </button>
                                        <button type="button" class="wrapper-icon" onclick="downMoveCase()">
                                            <div class="down-icon"></div>
                                        </button>
                                        <a href="<?= BASEURL; ?>testcase/editTestCase/<?= $test_case['id']; ?>" class="wrapper-icon">
                                            <div class="edit-icon"></div>
                                        </a>
                                        <button type="button" class="wrapper-icon" data-bs-toggle="modal" data-bs-target="#deleteCase" data-id="<?= $test_case['id']; ?>">
                                            <div class="delete-icon"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>
                        <div class="case-menu position-relative">
                            <p class="text-decoration-none">Data Test Case Not Found!</p>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="wrapper-close"></div>
        </div>
    </div>

    <div class="modal fade" id="addNewSection" tabindex="-1" aria-labelledby="addNewSectionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Add New Test Section</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form id="formaddNewSection" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="test_suite_id" data-value="test_suite_id">
                        <input type="hidden" name="project_id" value="<?= $_SESSION['project']; ?>">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputAddSection" name="name" autocomplete="off" required>
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-add-section button-transparent d-flex align-items-center">
                                <div class="reset-icon"></div>
                                Reset
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSection" tabindex="-1" aria-labelledby="editSectionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Edit Test Section</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form id="formEditSection" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="id" data-value="id">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputEditSection" name="name" data-value="name" required>
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-edit-section button-transparent d-flex align-items-center">
                                <div class="reset-icon"></div>
                                Reset
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteSection" tabindex="-1" aria-labelledby="deleteSectionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column" style="gap: 14px !important;">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Are you sure?</h4>
                </div>
                <div class="content-body">
                    <form id="formDeleteSection" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <p class="caption-delete">Are you sure you want to delete this <span>test section</span>? This action cannot be undone, and the <span>test section</span> will be permanently removed from the system.</p>
                        <div class="wrapper d-flex gap-2">
                            <button class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewSuite" tabindex="-1" aria-labelledby="addNewSuiteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Add New Test Suite</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form action="<?= BASEURL; ?>testcase/addTestSuiteAction" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="project_id" value="<?= $_SESSION['project']; ?>">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputAddSuite" name="name" autocomplete="off" required>
                        </div>
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Description</p>
                            <input type="text" class="input position-relative" id="descriptionInputAddSuite" name="description" autocomplete="off">
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-add-suite button-transparent d-flex align-items-center">
                                <div class="reset-icon"></div>
                                Reset
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSuite" tabindex="-1" aria-labelledby="editSuiteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Edit Test Suite</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form id="formEditSuite" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="id" data-value="id">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputEditSuite" name="name" data-value="name" autocomplete="off" required>
                        </div>
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Description</p>
                            <input type="text" class="input position-relative" id="descriptionInputEditSuite" name="description" data-value="description" autocomplete="off">
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-edit-suite button-transparent d-flex align-items-center">
                                <div class="reset-icon"></div>
                                Reset
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteSuite" tabindex="-1" aria-labelledby="deleteSuiteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column" style="gap: 14px !important;">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Are you sure?</h4>
                </div>
                <div class="content-body">
                    <form id="formDeleteSuite" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <p class="caption-delete">Are you sure you want to delete this <span>test suite</span>? This action cannot be undone, and the <span>test suite</span> will be permanently removed from the system.</p>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCase" tabindex="-1" aria-labelledby="deleteCaseLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column" style="gap: 14px !important;">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Are you sure?</h4>
                </div>
                <div class="content-body">
                    <form id="formDeleteCase" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <p class="caption-delete">Are you sure you want to delete this <span>test case</span>? This action cannot be undone, and the <span>test case</span> will be permanently removed from the system.</p>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="button-transparent d-flex align-items-center" data-bs-dismiss="modal">
                                <div class="cancel-icon"></div>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).on('click', '[data-bs-target="#addNewSection"]', function() {
        let id = $(this).data('id');
        $('#formaddNewSection').attr('action', 'http://localhost/disqes/public/testcase/addTestSectionAction/' + id);
        $('[data-value="test_suite_id"]').val(id);
    });

    $(document).on('click', '[data-bs-target="#editSection"]', function() {
        let id = $(this).data('id');
        $('#formEditSection').attr('action', 'http://localhost/disqes/public/testcase/editTestSectionAction/' + id);
        $.ajax({
            type: 'get',
            url: 'http://localhost/disqes/public/testcase/editTestSection/' + id,
            success: function(data) {
                console.log(data);
                $('[data-value="id"]').val(data.id);
                $('[data-value="name"]').val(data.name);
            }
        });
    });

    $(document).on('click', '[data-bs-target="#deleteSection"]', function() {
        let id = $(this).data('id');
        $('#formDeleteSection').attr('action', 'http://localhost/disqes/public/testcase/deleteTestSectionAction/' + id);
    });

    $(document).on('click', '[data-bs-target="#editSuite"]', function() {
        let id = $(this).data('id');
        $('#formEditSuite').attr('action', 'http://localhost/disqes/public/testcase/editTestSuiteAction/' + id);
        $.ajax({
            type: 'get',
            url: 'http://localhost/disqes/public/testcase/editTestSuite/' + id,
            success: function(data) {
                $('[data-value="id"]').val(data.id);
                $('[data-value="name"]').val(data.name);
                $('[data-value="description"]').val(data.description);
            }
        });
    });

    $(document).on('click', '[data-bs-target="#deleteSuite"]', function() {
        let id = $(this).data('id');
        $('#formDeleteSuite').attr('action', 'http://localhost/disqes/public/testcase/deleteTestSuiteAction/' + id);
    });

    $(document).on('click', '[data-bs-target="#deleteCase"]', function() {
        let id = $(this).data('id');
        $('#formDeleteCase').attr('action', 'http://localhost/disqes/public/testcase/deleteTestCaseAction/' + id);
    });

    let listMoveCase = document.querySelector('.list-move-case');
    let listMoveSuite = document.querySelector('.list-move-suite');
    const filterButton = document.querySelector('.filter-button');
    const filterBar = document.querySelector('.filter-bar');
    const resetButton = document.querySelector('.reset-button');
    const nameInput = document.querySelector('#nameInput');
    const arrowSuite = document.querySelectorAll('.arrow-suite');
    const wrapperHeader = document.querySelectorAll('.wrapper-header');
    const caseMenu = document.querySelectorAll('.case-menu');
    const suiteMenu = document.querySelectorAll('.suite-menu');
    const nameInputAddSuite = document.querySelector('#nameInputAddSuite');
    const descriptionInputAddSuite = document.querySelector('#descriptionInputAddSuite');
    const resetButtonAddSuite = document.querySelector('.reset-button-add-suite');
    const nameInputEditSuite = document.querySelector('#nameInputEditSuite');
    const descriptionInputEditSuite = document.querySelector('#descriptionInputEditSuite');
    const resetButtonEditSuite = document.querySelector('.reset-button-edit-suite');
    const nameInputAddSection = document.querySelector('#nameInputAddSection');
    const resetButtonAddSection = document.querySelector('.reset-button-add-section');
    const nameInputEditSection = document.querySelector('#nameInputEditSection');
    const resetButtonEditSection = document.querySelector('.reset-button-edit-section');

    function upMoveCase() {
        const selectedItem = document.querySelector('.wrapper-action.active').parentElement.parentElement;

        if (selectedItem && selectedItem.previousElementSibling) {
            listMoveCase.insertBefore(selectedItem, selectedItem.previousElementSibling);
        }
    }

    function downMoveCase() {
        const selectedItem = document.querySelector('.wrapper-action.active').parentElement.parentElement;

        if (selectedItem && selectedItem.nextElementSibling) {
            listMoveCase.insertBefore(selectedItem.nextElementSibling, selectedItem);
        }
    }

    function upMoveSuite() {
        const selectedItem = document.querySelector('.wrapper-action.active').parentElement.parentElement.parentElement;

        if (selectedItem && selectedItem.previousElementSibling) {
            listMoveSuite.insertBefore(selectedItem, selectedItem.previousElementSibling);
        }
    }

    function downMoveSuite() {
        const selectedItem = document.querySelector('.wrapper-action.active').parentElement.parentElement.parentElement;

        if (selectedItem && selectedItem.nextElementSibling) {
            listMoveSuite.insertBefore(selectedItem.nextElementSibling, selectedItem);
        }
    }

    function upMoveSection() {
        const listMoveSection = document.querySelector('.wrapper-action.active').parentElement.parentElement.parentElement;
        const selectedItem = document.querySelector('.wrapper-action.active').parentElement.parentElement;

        if (selectedItem && selectedItem.previousElementSibling) {
            listMoveSection.insertBefore(selectedItem, selectedItem.previousElementSibling);
        }
    }

    function downMoveSection() {
        const listMoveSection = document.querySelector('.wrapper-action.active').parentElement.parentElement.parentElement;
        const selectedItem = document.querySelector('.wrapper-action.active').parentElement.parentElement;

        if (selectedItem && selectedItem.nextElementSibling) {
            listMoveSection.insertBefore(selectedItem.nextElementSibling, selectedItem);
        }
    }

    filterButton.addEventListener('click', function() {
        filterBar.classList.toggle('active');
    });

    resetButton.addEventListener('click', function() {
        nameInput.value = '';

        const filterSearching = document.querySelector('.filter-searching');
        if (filterSearching) {
            filterSearching.style.display = 'none';
        }
    });

    resetButtonAddSuite.addEventListener('click', function() {
        nameInputAddSuite.value = '';
        descriptionInputAddSuite.value = '';
    });

    resetButtonEditSuite.addEventListener('click', function() {
        nameInputEditSuite.value = '';
        descriptionInputEditSuite.value = '';
    });

    resetButtonAddSection.addEventListener('click', function() {
        nameInputAddSection.value = '';
    });

    resetButtonEditSection.addEventListener('click', function() {
        nameInputEditSection.value = '';
    });

    arrowSuite.forEach(element => {
        element.addEventListener('click', function() {
            const wrapperSuite = element.parentElement.parentElement.parentElement;
            const suiteMenu = wrapperSuite.querySelectorAll('.suite-menu');
            for (let i = 0; i < suiteMenu.length; i++) {
                suiteMenu[i].classList.toggle('active');
            };
            this.classList.toggle('active');
        });
    });

    wrapperHeader.forEach(element => {
        element.addEventListener('mouseover', function() {
            const wrapperAction = this.querySelector('.wrapper-action');
            wrapperAction.classList.add('active');
        });
        element.addEventListener('mouseout', function() {
            const wrapperAction = this.querySelector('.wrapper-action');
            wrapperAction.classList.remove('active');
        });
    });

    caseMenu.forEach(element => {
        element.addEventListener('mouseover', function() {
            const wrapperAction = this.querySelector('.wrapper-action');
            wrapperAction.classList.add('active');
        });
        element.addEventListener('mouseout', function() {
            const wrapperAction = this.querySelector('.wrapper-action');
            wrapperAction.classList.remove('active');
        });
    });

    suiteMenu.forEach(element => {
        element.addEventListener('mouseover', function() {
            const wrapperAction = this.querySelector('.wrapper-action');
            wrapperAction.classList.add('active');
        });
        element.addEventListener('mouseout', function() {
            const wrapperAction = this.querySelector('.wrapper-action');
            wrapperAction.classList.remove('active');
        });
    });
</script>