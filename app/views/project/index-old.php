<div class="content content-project">
    <div class="row">
        <div class="col-12">
            <div class="flasher-wrap w-100">
                <?php Flasher::flash(); ?>
            </div>
        </div>
    </div>
    <div class="row section-gap">
        <div class="col-12">
            <h4 class="title">Projects</h4>
        </div>
    </div>
    <div class="row section-gap">
        <div class="col-md-4 col-lg-3 mb-4">
            <button type="button" class="card-project d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#addNewProject">
                <div class="wrapper d-flex flex-column align-items-center">
                    <div class="plus-icon"></div>
                    <h5 class="title-add-project">New Project</h5>
                </div>
            </button>
        </div>
        <?php $i = 1; ?>
        <?php foreach ($data['projects'] as $project) : ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card-project d-flex flex-column justify-content-between">
                    <div class="project-header d-flex align-items-center justify-content-between">
                        <h6 class="project-title"><?= $project['name'] ?></h6>
                        <div class="popup-group position-relative">
                            <div class="wrapper-icon">
                                <div class="bar-icon"></div>
                            </div>
                            <div class="action-popup">
                                <button type="button" class="popup-button" data-bs-toggle="modal" data-bs-target="#editProject" data-id="<?= $project['id']; ?>">Edit</button>
                                <button type="button" class="popup-button" data-bs-toggle="modal" data-bs-target="#deleteProject" data-id="<?= $project['id']; ?>">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="project-body d-flex justify-content-between align-items-center">
                        <div class="wrapper d-flex align-items-center gap-4">
                            <!-- <a href="<?= BASEURL; ?>testcase/project/<?= $project['id']; ?>" class="testcase-group">
                                <div class="testcase-icon"></div>
                                <p class="badge-count"><?= $project['test_case_count']; ?></p>
                            </a> -->
                            <a href="<?= BASEURL; ?>testcase/project/<?= $project['id']; ?>" class="testcase-group">
                                <div class="testsuite-icon"></div>
                                <p class="badge-count"><?= $project['test_case_count']; ?></p>
                            </a>
                            <!-- <a href="<?= BASEURL; ?>testcase" class="testsuite-group">
                                <div class="testsuite-icon"></div>
                                <p class="badge-count badge-danger"><?= $project['test_suite_count']; ?></p>
                            </a> -->
                        </div>
                        <a href="<?= BASEURL; ?>project/data/<?= $project['id']; ?>" class="wrapper-icon">
                            <div class="dashboard-icon"></div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="modal fade" id="addNewProject" tabindex="-1" aria-labelledby="addNewProjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Add New Project</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form action="<?= BASEURL; ?>project/addAction" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputAddProject" name="name" autocomplete="off" required>
                        </div>
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Description</p>
                            <input type="text" class="input position-relative" id="descriptionInputAddProject" name="description" autocomplete="off">
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-add-project button-transparent d-flex align-items-center">
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

    <div class="modal fade" id="editProject" tabindex="-1" aria-labelledby="editProjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Edit Project</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form id="formEditProject" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="id" data-value="id">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputEditProject" name="name" autocomplete="off" data-value="name" required>
                        </div>
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Description</p>
                            <input type="text" class="input position-relative" id="descriptionInputEditProject" name="description" autocomplete="off" data-value="description">
                        </div>
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-edit-project button-transparent d-flex align-items-center">
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

    <div class="modal fade" id="deleteProject" tabindex="-1" aria-labelledby="deleteProjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column" style="gap: 14px !important;">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Are you sure?</h4>
                </div>
                <div class="content-body">
                    <form id="formDeleteProject" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <p class="caption-delete">Are you sure you want to delete this <span>project</span>? This action cannot be undone, and the <span>project</span> will be permanently removed from the system.</p>
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
    $(document).on('click', '[data-bs-target="#editProject"]', function() {
        let id = $(this).data('id');
        $('#formEditProject').attr('action', 'http://localhost/disqes/public/project/editAction/' + id);
        $.ajax({
            type: 'get',
            url: 'http://localhost/disqes/public/project/edit/' + id,
            success: function(data) {
                $('[data-value="id"]').val(data.id);
                $('[data-value="name"]').val(data.name);
                $('[data-value="description"]').val(data.description);
            }
        });
    });

    $(document).on('click', '[data-bs-target="#deleteProject"]', function() {
        let id = $(this).data('id');
        $('#formDeleteProject').attr('action', 'http://localhost/disqes/public/project/deleteAction/' + id);
    });

    const tableBody = document.querySelectorAll('.table-body');
    const nameInputAddProject = document.querySelector('#nameInputAddProject');
    const descriptionInputAddProject = document.querySelector('#descriptionInputAddProject');
    const resetButtonAddProject = document.querySelector('.reset-button-add-project');
    const nameInputEditProject = document.querySelector('#nameInputEditProject');
    const descriptionInputEditProject = document.querySelector('#descriptionInputEditProject');
    const resetButtonEditProject = document.querySelector('.reset-button-edit-project');
    const popupGroup = document.querySelectorAll('.popup-group');

    popupGroup.forEach(element => {
        element.addEventListener('click', function(e) {
            if (e.target.className == 'bar-icon') {
                const popup = element.querySelector('.action-popup');
                popup.classList.toggle('active');
            }
        });
    });

    resetButtonAddProject.addEventListener('click', function() {
        nameInputAddProject.value = '';
        descriptionInputAddProject.value = '';
    });

    resetButtonEditProject.addEventListener('click', function() {
        nameInputEditProject.value = '';
        descriptionInputEditProject.value = '';
    });

    tableBody.forEach(element => {
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