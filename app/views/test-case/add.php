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
            <h4 class="title">New Test Case</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="<?= BASEURL; ?>testcase/addTestCaseAction" method="post" class="card-form d-flex flex-column w-100">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Name <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="nameInputAddCase" name="name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Suite <span class="input-required">*</span></p>
                            <select class="input position-relative" id="suiteInputAddCase" name="test_suite_id" required>
                                <?php foreach ($data['test_suites'] as $test_suite) : ?>
                                    <option value="<?= $test_suite['id']; ?>"><?= $test_suite['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" id="sectionInput">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Section <span class="input-required">*</span></p>
                            <select class="input position-relative" id="sectionInputAddCase" name="test_section_id" required>
                                <option value="-">Select suite first</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Priority <span class="input-required">*</span></p>
                            <select class="input position-relative" id="priorityInputAddCase" name="priority">
                                <option value="Not Set" selected>Not Set</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Behavior <span class="input-required">*</span></p>
                            <select class="input position-relative" id="behaviorInputAddCase" name="behavior" required>
                                <option value="Not Set" selected>Not Set</option>
                                <option value="Positive">Positive</option>
                                <option value="Negative">Negative</option>
                                <option value="Destructive">Destructive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="input-wrapper w-100 position-relative">
                            <p class="caption-input">Preconditions <span class="input-required">*</span></p>
                            <input type="text" class="input position-relative" id="preconditionInputAddCase" name="precondition" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="wrapper d-flex justify-content-between align-items-center">
                                    <h6 class="subtitle">Steps</h6>
                                    <div class="button-outline button-step d-flex align-items-center">
                                        <div class="add-outline-icon"></div>
                                        Step
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row row-step">
                                    <div class="col-12 d-flex justify-content-between align-items-center gap-4 col-step">
                                        <div class="input-wrapper w-100 position-relative" id="inputWrapperInstructions">
                                            <div class="caption-input-table">
                                                <p>Instructions</p>
                                            </div>
                                            <textarea id="instructionsInput" name="instruction[]" autocomplete="off"></textarea>
                                        </div>
                                        <div class="input-wrapper w-100 position-relative">
                                            <p class="caption-input">Expected Result</p>
                                            <input type="text" class="input position-relative" id="expectedInputAddCase" name="expected_result[]" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="wrapper d-flex gap-2">
                            <button type="submit" class="button-primary d-flex align-items-center">
                                <div class="save-icon"></div>
                                Save
                            </button>
                            <button type="button" class="reset-button-add-case button-transparent d-flex align-items-center">
                                <div class="reset-icon"></div>
                                Reset
                            </button>
                            <a href="<?= BASEURL; ?>testcase" class="button-transparent d-flex align-items-center">
                                <div class="cancel-icon"></div>
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#suiteInputAddCase").change(function() {
            suiteInput = $(this).val();

            $('#sectionInputAddCase').empty();
            $.ajax({
                type: 'get',
                url: 'http://localhost/disqes/testcase/getAllTestSection/' + suiteInput,
                success: function(data) {
                    $('#sectionInputAddCase').append(data);
                }
            });
        });
    });

    const rowStep = document.querySelector('.row-step');
    const stepButton = document.querySelector('.button-step');
    const resetButton = document.querySelector('.reset-button-add-case');

    resetButton.addEventListener('click', function() {
        const nameInput = document.querySelector('#nameInputAddCase');
        const suiteInput = document.querySelector('#suiteInputAddCase');
        const sectionInput = document.querySelector('#sectionInputAddCase');
        const priorityInputAddCase = document.querySelector('#priorityInputAddCase');
        const behaviorInputAddCase = document.querySelector('#behaviorInputAddCase');
        const preconditionInput = document.querySelector('#preconditionInputAddCase');
        const expectedInput = document.querySelectorAll('#expectedInputAddCase');

        nameInput.value = '';
        priorityInputAddCase.value = 'Not Set';
        priorityInputAddCase.html = 'Not Set';
        behaviorInputAddCase.value = 'Not Set';
        behaviorInputAddCase.html = 'Not Set';
        preconditionInput.value = '';

        for (let i = 0; i < expectedInput.length; i++) {
            expectedInput[i].value = '';
        }
    });

    rowStep.addEventListener('click', function(e) {
        if (e.target.className === 'add-table-icon') {
            const addTableIcon = e.target;
            addTableIcon.classList.add('d-none');

            const wrapperButton = addTableIcon.parentElement;
            const removeTableButton = wrapperButton.querySelector('.remove-table-icon');
            removeTableButton.classList.remove('d-none');

            const inputWrapper = addTableIcon.parentElement.parentElement.parentElement;
            const inputTable = inputWrapper.querySelector('#inputTable');
            const input = inputWrapper.querySelector('#inputText');

            inputTable.classList.remove('d-none');
            input.classList.add('d-none');
        } else if (e.target.className === 'remove-table-icon') {
            const removeTableIcon = e.target;
            removeTableIcon.classList.add('d-none');

            const wrapperButton = removeTableIcon.parentElement;
            const addTableButton = wrapperButton.querySelector('.add-table-icon');
            addTableButton.classList.remove('d-none');

            const inputWrapper = removeTableIcon.parentElement.parentElement.parentElement;
            const inputTable = inputWrapper.querySelector('#inputTable');
            const input = inputWrapper.querySelector('#inputText');

            inputTable.classList.add('d-none');
            input.classList.remove('d-none');
        } else if (e.target.className === 'minus-icon') {
            const minusComponentIcon = e.target;
            const colStep = minusComponentIcon.parentElement.parentElement;
            colStep.remove();
        }
    });

    stepButton.addEventListener('click', function() {
        const colStep = document.createElement('div');
        colStep.classList.add("col-step");
        colStep.classList.add("col-12");
        colStep.classList.add("gap-4");
        colStep.classList.add("mt-4");

        const inputWrapperInstructions = document.createElement('div');
        inputWrapperInstructions.classList.add("input-wrapper");

        const captionInputTable = document.createElement('div');
        captionInputTable.classList.add('caption-input-table');
        inputWrapperInstructions.appendChild(captionInputTable);

        const pInstructions = document.createElement('p');
        const textPInstructions = document.createTextNode('Instructions');
        pInstructions.appendChild(textPInstructions);
        captionInputTable.appendChild(pInstructions);

        const textareaInstructions = document.createElement('textarea');
        textareaInstructions.setAttribute('name', 'instruction[]');
        textareaInstructions.id = 'instructionsInput';

        const inputWrapperExpected = document.createElement('div');
        inputWrapperExpected.classList.add("input-wrapper");

        const pExpected = document.createElement('p');
        pExpected.classList.add('caption-input');

        const textPExpected = document.createTextNode('Expected Result');
        pExpected.appendChild(textPExpected);

        const inputExpected = document.createElement('input');
        inputExpected.classList.add('input');
        inputExpected.type = 'text';
        inputExpected.id = 'expectedInputAddCase';
        inputExpected.setAttribute('name', 'expected_result[]');

        const wrapperIcon = document.createElement('div');
        wrapperIcon.classList.add('wrapper-icon');
        const minusIcon = document.createElement('div');
        minusIcon.classList.add('minus-icon');

        inputWrapperInstructions.appendChild(textareaInstructions);

        inputWrapperExpected.appendChild(pExpected);
        inputWrapperExpected.appendChild(inputExpected);

        wrapperIcon.appendChild(minusIcon);

        colStep.appendChild(inputWrapperInstructions);
        colStep.appendChild(inputWrapperExpected);
        colStep.appendChild(wrapperIcon);

        rowStep.appendChild(colStep);

        var editor = new FroalaEditor('#instructionsInput');
    });

    var editor = new FroalaEditor('#instructionsInput');
</script>