<div class="content content-project">
    <div class="row">
        <div class="col-12">
            <div class="flasher-wrap w-100">
                <?php Flasher::flash(); ?>
            </div>
        </div>
    </div>
    <div class="row section-gap">
        <div class="col-12 d-flex justify-content-md-between align-items-center gap-3 gap-md-0">
            <h4 class="title">Project</h4>
            <button type="button" class="button-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addNewProject">
                <div class="add-icon"></div>
                New
            </button>
        </div>
    </div>
    <div class="row section-gap">
        <div class="col-12 d-flex justify-content-md-between align-items-center gap-3 gap-md-0">
            <div class="wrapper-filter">
                <div class="filter-content">
                    <form action="" method="POST" style="width: 100%; gap: 12px;" class="d-flex align-items-center">
                        <input type="hidden" name="project_id" value="<?= $_SESSION['project']; ?>">
                        <div class="row">
                            <div class="col-12 mt-4 mt-md-0">
                                <div class="input-wrapper w-100 position-relative">
                                    <!-- <p class="caption-input">Name <span class="input-required">*</span></p> -->
                                    <input type="text" class="input position-relative" id="nameInput" name="name" autocomplete="off" required value="" placeholder="Search for Projects" style="padding: 14px 18px;">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button-primary d-flex align-items-center" style="padding: 14px 18px;">
                            <div class="search-icon"></div>
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-header d-flex align-items-center">
                <div class="row align-items-center w-100">
                    <div class="col">
                        <p>Name</p>
                    </div>
                    <div class="col d-none d-md-inline-block">
                        <p>Team Members</p>
                    </div>
                    <div class="col-2">
                        <p></p>
                    </div>
                </div>
            </div>

            <?php $i = 1; ?>
            <?php foreach ($data['projects'] as $project) : ?>
                <div class="table-body d-flex align-items-center" style="padding-top: 16px; padding-bottom: 16px;">
                    <div class="row align-items-center w-100">
                        <div class="col d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=<?= $project['name']; ?>&background=7582eb&color=111827&bold=true" class="img-fluid rounded" alt="Image Project" width="40">
                            <p><?= $project['name']; ?></p>
                        </div>
                        <div class="col d-none d-md-flex gap-2">
                            <?php $members = explode(',', $project['user_id']); ?>
                            <?php foreach ($data['users'] as $user) : ?>
                                <?php if (in_array($user['id'], $members)) : ?>
                                    <img src="https://ui-avatars.com/api/?name=<?= $user['username'];; ?>&background=192036&color=7582eb&bold=true" class="img-fluid rounded" alt="Image Project" width="40">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <div class="popup-group position-relative" style="width: fit-content;">
                                <div class="wrapper-icon">
                                    <div class="bar-icon"></div>
                                </div>
                                <div class="action-popup">
                                    <a href="<?= BASEURL; ?>project/data/<?= $project['id']; ?>" class="popup-button">Dashboard</a>
                                    <a href="<?= BASEURL; ?>testcase/project/<?= $project['id']; ?>" class="popup-button">Manage</a>
                                    <?php if ($_SESSION['role'] == 'super admin') : ?>
                                        <button type="button" class="popup-button" data-bs-toggle="modal" data-bs-target="#addMemberProject" data-id="<?= $project['id']; ?>">Team Member</button>
                                        <button type="button" class="popup-button" data-bs-toggle="modal" data-bs-target="#editProject" data-id="<?= $project['id']; ?>">Edit</button>
                                        <button type="button" class="popup-button" data-bs-toggle="modal" data-bs-target="#deleteProject" data-id="<?= $project['id']; ?>">Delete</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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

    <div class="modal fade" id="addMemberProject" tabindex="-1" aria-labelledby="addMemberProjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex flex-column">
                <div class="content-header d-flex justify-content-between align-items-center">
                    <h4 class="title">Member Project</h4>
                    <div class="wrapper-icon" data-bs-dismiss="modal">
                        <div class="exit-icon"></div>
                    </div>
                </div>
                <div class="content-body">
                    <form id="formAddMemberProject" method="post" style="width: 100%; gap: 24px;" class="d-flex flex-column">
                        <input type="hidden" name="id" data-value="id">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Add New Member</p>
                            <select id="newInputAddmember" name="user_id" class="input position-relative">
                            </select>
                        </div>
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
    $(document).on('click', '[data-bs-target="#addMemberProject"]', function() {
        let id = $(this).data('id');
        $('#formAddMemberProject').attr('action', 'http://localhost/disqes/public/project/AddMemberProject');

        $('#newInputAddmember').empty();
        $.ajax({
            type: 'get',
            url: 'http://localhost/disqes/public/project/memberProject/' + id,
            success: function(data) {
                $('#newInputAddmember').append(data);
            }
        });
        $.ajax({
            type: 'get',
            url: 'http://localhost/disqes/public/project/edit/' + id,
            success: function(data) {
                console.log(data);
                $('[data-value="id"]').val(data.id);
            }
        });
    });

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