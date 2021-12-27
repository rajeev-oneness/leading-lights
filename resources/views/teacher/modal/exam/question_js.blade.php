<script>
    var i = 0;
    var k = 0;
    var question_total_marks = 0;

    $(document).on("click", ".add_question_section", function() {
        var exam_id = $(this).data('id');
        var exam_full_marks = $(this).data('full-marks');
        $(".modal-body #exam_id").val(exam_id);
        // $(".modal-body #exam_total_marks").val(exam_total_marks);
        // $(".modal-header #exam_full_marks").append(exam_full_marks);
    });
    // Descriptive Question

    $("#dynamic-ar").click(function() {
        // Start
        var errorFlagOne = 0;
        var inputs = document.getElementById('dynamicAddRemove').getElementsByTagName('input');
        var all_textarea = document.getElementById('dynamicAddRemove').getElementsByTagName('textarea');
        for (var i = 0; i < inputs.length; ++i)
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.file_error' + k).html('');
                            }, 5000);
                            $('.file_error' + k).text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        } else {
                            setTimeout(() => {
                                $('.file_error').html('');
                            }, 5000);
                            $('.file_error').text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        }
                        errorFlagOne = 1;
                    }

                }

            }

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (k == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (k)).text('');
                        }, 5000);
                        $('.textarea_error' + (k)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }

        // End

        if (errorFlagOne == 1) {
            return false;
        } else {
            $('.textarea_error').text('');
            $("#dynamicAddRemove").append(`<hr>
            <p class="font-weight-bold text-center">Question No: ${k+2}</p>
        <div class="form-group">
            <label for="question" class="font-weight-bold">Question<span class="text-danger">*</span></label>
            <textarea type="text" name="addMoreInputFields[${i}][question]" class="form-control" cols="2" rows="2"></textarea>
            <span class="textarea_error${i} text-danger"></span>
        </div>
        <div class="form-group">
            <label for="image" class="font-weight-bold">Image</label>
            <input type="file" class="form-control-file" name="addMoreInputFields[${i}][image]" id="image">
            <span class="file_error${i} text-danger"></span>
        </div>
        <div class="form-group">
            <label for="marks" class="font-weight-bold">Marks</label>
            <select id="marks" class="form-control" name="addMoreInputFields[${i}][marks]">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
         </div>
        `);
        document.getElementById('dynamicAddRemove').scrollIntoView(false);
            ++i;
            ++k;
        }
    });

    $('#btnSubmit').on('click', function(e) {
        e.preventDefault();
        // Start
        var errorFlagOne = 0;
        var inputs = document.getElementById('dynamicAddRemove').getElementsByTagName('input');
        var all_textarea = document.getElementById('dynamicAddRemove').getElementsByTagName('textarea');
        for (var i = 0; i < inputs.length; ++i)
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        setTimeout(() => {
                            $('.file_error').html('');
                        }, 5000);
                        $('.file_error').text('Plz select a valid type image.Only jpg,jpeg and png allowed');
                        errorFlagOne = 1;
                    }

                }

            }

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (i == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (i)).text('');
                        }, 5000);
                        $('.textarea_error' + (i + 1)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }

        // End

        if (errorFlagOne == 1) {
            return false;
        } else {
            $('.desc-question-form').submit();
        }

    });

    // MCQ Question

    $("#dynamic-ar-mcq").click(function() {
        var errorFlagOne = 0;
        var individual_marks = 0;
        var inputs = document.getElementById('dynamicAddRemoveMCQ').getElementsByTagName('input');
        var all_textarea = document.getElementById('dynamicAddRemoveMCQ').getElementsByTagName('textarea');
        for (var i = 0; i < inputs.length; ++i) {
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.file_error' + k).html('');
                            }, 5000);
                            $('.file_error' + k).text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        } else {
                            setTimeout(() => {
                                $('.file_error').html('');
                            }, 5000);
                            $('.file_error').text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        }
                        errorFlagOne = 1;
                    }

                }

            }
            if (inputs[i].type === 'text') {
                if (inputs[i].value == '') {
                    if (k > 0) {
                        setTimeout(() => {
                            $('.option_1_err' + (k)).text('');
                        }, 5000);
                        $('.option_1_err' + (k)).text('Option 1 can\'t be blank');

                        setTimeout(() => {
                            $('.option_2_err' + (k)).text('');
                        }, 5000);
                        $('.option_2_err' + (k)).text('Option 2 can\'t be blank');

                        setTimeout(() => {
                            $('.option_3_err' + (k)).text('');
                        }, 5000);
                        $('.option_3_err' + (k)).text('Option 3 can\'t be blank');

                        setTimeout(() => {
                            $('.option_4_err' + (k)).text('');
                        }, 5000);
                        $('.option_4_err' + (k)).text('Option 4 can\'t be blank');

                        setTimeout(() => {
                            $('.answer_err' + (k)).text('');
                        }, 5000);
                        $('.answer_err' + (k)).text('Right answer can\'t be blank');

                    } else {
                        setTimeout(() => {
                            $('.option_1_err').text('');
                        }, 5000);
                        $('.option_1_err').text('Option 1 can\'t be blank');

                        setTimeout(() => {
                            $('.option_2_err').text('');
                        }, 5000);
                        $('.option_2_err').text('Option 2 can\'t be blank');

                        setTimeout(() => {
                            $('.option_3_err').text('');
                        }, 5000);
                        $('.option_3_err').text('Option 3 can\'t be blank');

                        setTimeout(() => {
                            $('.option_4_err').text('');
                        }, 5000);
                        $('.option_4_err').text('Option 4 can\'t be blank');

                        setTimeout(() => {
                            $('.answer_err').text('');
                        }, 5000);
                        $('.answer_err').text('Right answer can\'t be blank');

                    }
                    errorFlagOne = 1;
                }

            }
        }

        for (let index = 0; index < all_textarea.length; ++index) {
            // console.log(k);
            individual_marks = 1;
        }

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (k == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (k)).text('');
                        }, 5000);
                        $('.textarea_error' + (k)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }

        // End
        if (errorFlagOne == 1) {
            return false;
        } else {
            // question_total_marks = (question_total_marks + individual_marks);
            // console.log(individual_marks,question_total_marks);
            // $('#remaining_question_marks').text(`Total marks ${question_total_marks}`);
            $("#dynamicAddRemoveMCQ").append(`<hr>
            <p class="font-weight-bold text-center">Question No: ${k+2}</p>
        <div class="form-group">
        <label for="question"><b>Question</b><span class="text-danger">*</span></label>
        <textarea type="text" name="addMoreInputFields[${i}][question]" class="form-control" cols="2" rows="2"></textarea>
        <span class="textarea_error${i} text-danger"></span>
        </div>
        <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" name="addMoreInputFields[${i}][image]" id="image">
        <span class="file_error${i} text-danger"></span>
        </div>
        <div class="form-group">
            <label for="options"><b>Options</b></label>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Option 1<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_1_err${i} text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="">Option 2<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_2_err${i} text-danger"></span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="">Option 3<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_3_err${i} text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="">Option 4<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_4_err${i} text-danger"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for=""><b>Right Option<span class="text-danger">*</span></b></label>
                    <input type="text" name="addMoreInputFields[${i}][answer]" class="form-control">
                    <span class="answer_err${i} text-danger"></span>
                </div>
            </div>
        </div>
        `);
        document.getElementById('dynamicAddRemoveMCQ').scrollIntoView(false);
            ++i;
            ++k;
        }
    });

    $('#btn_mcq_submit').on('click', function(e) {
        e.preventDefault();
        // Start
        var errorFlagOne = 0;
        // var exam_full_marks = $(".modal-header #exam_full_marks").val();
        var inputs = document.getElementById('dynamicAddRemoveMCQ').getElementsByTagName('input');
        var all_textarea = document.getElementById('dynamicAddRemoveMCQ').getElementsByTagName('textarea');
        for (var i = 0; i < inputs.length; ++i) {
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.file_error' + k).html('');
                            }, 5000);
                            $('.file_error' + k).text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        } else {
                            setTimeout(() => {
                                $('.file_error').html('');
                            }, 5000);
                            $('.file_error').text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        }
                        errorFlagOne = 1;
                    }

                }

            }
            if (inputs[i].type === 'text') {
                if (inputs[i].value == '') {
                    if (k > 0) {
                        setTimeout(() => {
                            $('.option_1_err' + (k)).text('');
                        }, 5000);
                        $('.option_1_err' + (k)).text('Option 1 can\'t be blank');

                        setTimeout(() => {
                            $('.option_2_err' + (k)).text('');
                        }, 5000);
                        $('.option_2_err' + (k)).text('Option 2 can\'t be blank');

                        setTimeout(() => {
                            $('.option_3_err' + (k)).text('');
                        }, 5000);
                        $('.option_3_err' + (k)).text('Option 3 can\'t be blank');

                        setTimeout(() => {
                            $('.option_4_err' + (k)).text('');
                        }, 5000);
                        $('.option_4_err' + (k)).text('Option 4 can\'t be blank');

                        setTimeout(() => {
                            $('.answer_err' + (k)).text('');
                        }, 5000);
                        $('.answer_err' + (k)).text('Right answer can\'t be blank');

                    } else {
                        setTimeout(() => {
                            $('.option_1_err').text('');
                        }, 5000);
                        $('.option_1_err').text('Option 1 can\'t be blank');

                        setTimeout(() => {
                            $('.option_2_err').text('');
                        }, 5000);
                        $('.option_2_err').text('Option 2 can\'t be blank');

                        setTimeout(() => {
                            $('.option_3_err').text('');
                        }, 5000);
                        $('.option_3_err').text('Option 3 can\'t be blank');

                        setTimeout(() => {
                            $('.option_4_err').text('');
                        }, 5000);
                        $('.option_4_err').text('Option 4 can\'t be blank');

                        setTimeout(() => {
                            $('.answer_err').text('');
                        }, 5000);
                        $('.answer_err').text('Right answer can\'t be blank');

                    }
                    errorFlagOne = 1;
                }

            }
        }

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (k == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (k)).text('');
                        }, 5000);
                        $('.textarea_error' + (k)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }

        // End
        if (errorFlagOne == 1) {
            return false;
        } else {
            $('.question-form').submit();
        }

    });

    // Mixed Question 

    $("#dynamic-ar-mixed-mcq").click(function() {
        var errorFlagOne = 0;
        var inputs = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('input');
        var all_marks  = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('select');
        // console.log(all_marks);
        var all_textarea = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('textarea');
        var question_type = $(`input:hidden[name="addMoreInputFields[${k}][question_type]"]`).val();
        for (var i = 0; i < inputs.length; ++i) {
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.file_error' + k).html('');
                            }, 5000);
                            $('.file_error' + k).text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        } else {
                            setTimeout(() => {
                                $('.file_error').html('');
                            }, 5000);
                            $('.file_error').text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        }
                        errorFlagOne = 1;
                    }

                }

            }
            if (inputs[i].type === 'text') {
                if (inputs[i].value == '') {
                    if (k > 0) {
                        setTimeout(() => {
                            $('.option_1_err' + (k)).text('');
                        }, 5000);
                        $('.option_1_err' + (k)).text('Option 1 can\'t be blank');

                        setTimeout(() => {
                            $('.option_2_err' + (k)).text('');
                        }, 5000);
                        $('.option_2_err' + (k)).text('Option 2 can\'t be blank');

                        setTimeout(() => {
                            $('.option_3_err' + (k)).text('');
                        }, 5000);
                        $('.option_3_err' + (k)).text('Option 3 can\'t be blank');

                        setTimeout(() => {
                            $('.option_4_err' + (k)).text('');
                        }, 5000);
                        $('.option_4_err' + (k)).text('Option 4 can\'t be blank');

                        setTimeout(() => {
                            $('.answer_err' + (k)).text('');
                        }, 5000);
                        $('.answer_err' + (k)).text('Right answer can\'t be blank');

                    } else {
                        setTimeout(() => {
                            $('.option_1_err').text('');
                        }, 5000);
                        $('.option_1_err').text('Option 1 can\'t be blank');

                        setTimeout(() => {
                            $('.option_2_err').text('');
                        }, 5000);
                        $('.option_2_err').text('Option 2 can\'t be blank');

                        setTimeout(() => {
                            $('.option_3_err').text('');
                        }, 5000);
                        $('.option_3_err').text('Option 3 can\'t be blank');

                        setTimeout(() => {
                            $('.option_4_err').text('');
                        }, 5000);
                        $('.option_4_err').text('Option 4 can\'t be blank');

                        setTimeout(() => {
                            $('.answer_err').text('');
                        }, 5000);
                        $('.answer_err').text('Right answer can\'t be blank');

                    }
                    errorFlagOne = 1;
                }

            }
        }

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (k == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (k)).text('');
                        }, 5000);
                        $('.textarea_error' + (k)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }

        for (let index = 0; index < all_marks.length; index++) {
            var individual_marks;
            if (question_type == 1) {
                individual_marks = 1;
            }else{
                individual_marks = parseInt(all_marks[index].value);
            }
            
        }

        // End
        if (errorFlagOne == 1) {
            return false;
        } else {
            question_total_marks = (question_total_marks + individual_marks);
            // console.log(individual_marks,question_total_marks);
            $('#remaining_question_marks').text(`Reaming marks ${question_total_marks}`);

            $("#dynamicAddRemoveMixed").append(`<hr>
            <p class="font-weight-bold text-center">Question No: ${k+2}</p>
        <div class="form-group">
        <label for="question"><b>Question</b><span class="text-danger">*</span></label>
        <textarea type="text" name="addMoreInputFields[${i}][question2]" class="form-control" cols="2" rows="2"></textarea>
        <span class="textarea_error${i} text-danger"></span>
        </div>
        <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" name="addMoreInputFields[${i}][image2]" id="image">
        <span class="file_error${i} text-danger"></span>
        </div>
        <div class="form-group">
            <label for="options"><b>Options</b></label>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Option 1<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_1_err${i} text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="">Option 2<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_2_err${i} text-danger"></span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="">Option 3<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_3_err${i} text-danger"></span>
                </div>
                <div class="col-md-6">
                    <label for="">Option 4<span class="text-danger">*</span></label>
                    <input type="text" name="addMoreInputFields[${i}][option][]" class="form-control">
                    <span class="option_4_err${i} text-danger"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for=""><b>Right Answer<span class="text-danger">*</span></b></label>
                    <input type="text" name="addMoreInputFields[${i}][answer]" class="form-control">
                    <span class="answer_err${i} text-danger"></span>
                </div>
            </div>
        </div>
        <input type="hidden" name="addMoreInputFields[${i}][question_type]" value="1">
        `);
        document.getElementById('dynamicAddRemoveMixed').scrollIntoView(false);
            ++i;
            ++k;
        }
    });
    $("#dynamic-ar-mixed-desc").click(function() {
        // Start
        var errorFlagOne = 0;      
        var individual_marks = 0;
        var inputs = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('input');
        var all_marks  = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('select');
        // console.log(all_marks);
        var question_type = $(`input:hidden[name="addMoreInputFields[${k}][question_type]"]`).val();
        var all_textarea = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('textarea');
        for (var i = 0; i < inputs.length; ++i) {
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.file_error' + k).html('');
                            }, 5000);
                            $('.file_error' + k).text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        } else {
                            setTimeout(() => {
                                $('.file_error').html('');
                            }, 5000);
                            $('.file_error').text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        }
                        errorFlagOne = 1;
                    }

                }

            }

            if (question_type == 1) {
                if (inputs[i].type === 'text') {
                    if (inputs[i].value == '') {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.option_1_err' + (k)).text('');
                            }, 5000);
                            $('.option_1_err' + (k)).text('Option 1 can\'t be blank');

                            setTimeout(() => {
                                $('.option_2_err' + (k)).text('');
                            }, 5000);
                            $('.option_2_err' + (k)).text('Option 2 can\'t be blank');

                            setTimeout(() => {
                                $('.option_3_err' + (k)).text('');
                            }, 5000);
                            $('.option_3_err' + (k)).text('Option 3 can\'t be blank');

                            setTimeout(() => {
                                $('.option_4_err' + (k)).text('');
                            }, 5000);
                            $('.option_4_err' + (k)).text('Option 4 can\'t be blank');

                            setTimeout(() => {
                                $('.answer_err' + (k)).text('');
                            }, 5000);
                            $('.answer_err' + (k)).text('Right answer can\'t be blank');

                        } else {
                            setTimeout(() => {
                                $('.option_1_err').text('');
                            }, 5000);
                            $('.option_1_err').text('Option 1 can\'t be blank');

                            setTimeout(() => {
                                $('.option_2_err').text('');
                            }, 5000);
                            $('.option_2_err').text('Option 2 can\'t be blank');

                            setTimeout(() => {
                                $('.option_3_err').text('');
                            }, 5000);
                            $('.option_3_err').text('Option 3 can\'t be blank');

                            setTimeout(() => {
                                $('.option_4_err').text('');
                            }, 5000);
                            $('.option_4_err').text('Option 4 can\'t be blank');

                            setTimeout(() => {
                                $('.answer_err').text('');
                            }, 5000);
                            $('.answer_err').text('Right answer can\'t be blank');

                        }
                        errorFlagOne = 1;
                    }

                }
            }
        }

        for (let index = 0; index < all_marks.length; ++index) {
            if (question_type == 1) {
                individual_marks = 1;
            }else{
                individual_marks = parseInt(all_marks[index].value);
               
            }
            
        }
        

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (k == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (k)).text('');
                        }, 5000);
                        $('.textarea_error' + (k)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }
        // End

        console.log();
        if (errorFlagOne == 1) {
            return false;
        } else {
            question_total_marks = (question_total_marks + individual_marks);
            console.log(question_total_marks);
            // console.log(individual_marks,question_total_marks);
            $('#remaining_question_marks').text(`Total marks ${question_total_marks}`);
            $('.textarea_error').text('');
            $("#dynamicAddRemoveMixed").append(`<hr>
            <p class="font-weight-bold text-center">Question No: ${k+2}</p>
        <div class="form-group">
            <label for="question">Question<span class="text-danger">*</span></label>
            <textarea type="text" name="addMoreInputFields[${i}][question1]" class="form-control" cols="2" rows="2"></textarea>
            <span class="textarea_error${i} text-danger"></span>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="addMoreInputFields[${i}][image1]" id="image">
            <span class="file_error${i} text-danger"></span>
        </div>
        <div class="form-group">
            <label for="marks">Marks<span class="text-danger">*</span></label>
            <select id="marks" class="form-control" name="addMoreInputFields[${i}][marks]">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <input type="hidden" name="addMoreInputFields[${i}][question_type]" value="2">
        `);
        document.getElementById('dynamicAddRemoveMixed').scrollIntoView(false);
            ++i;
            ++k;
        }
    });


    $('#btn_mixed_submit').on('click', function(e) {
        e.preventDefault();
        // Start
        var errorFlagOne = 0;
        var inputs = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('input');
        var all_textarea = document.getElementById('dynamicAddRemoveMixed').getElementsByTagName('textarea');
        var question_type = $(`input:hidden[name="addMoreInputFields[${k}][question_type]"]`).val();
        for (var i = 0; i < inputs.length; ++i) {
            if (inputs[i].type === 'file') {
                if (inputs[i].value !== '') {
                    var filetype = inputs[i].value.split('.')[1];
                    var match = ['image/jpeg', 'image/jpg'];

                    if ((filetype == 'jpg') || (filetype == 'jpeg') || (filetype == 'png')) {

                    } else {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.file_error' + k).html('');
                            }, 5000);
                            $('.file_error' + k).text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        } else {
                            setTimeout(() => {
                                $('.file_error').html('');
                            }, 5000);
                            $('.file_error').text(
                                'Plz select a valid type image.Only jpg,jpeg and png allowed');
                        }
                        errorFlagOne = 1;
                    }

                }

            }
            if (question_type == 1) {
                if (inputs[i].type === 'text') {
                    if (inputs[i].value == '') {
                        if (k > 0) {
                            setTimeout(() => {
                                $('.option_1_err' + (k)).text('');
                            }, 5000);
                            $('.option_1_err' + (k)).text('Option 1 can\'t be blank');

                            setTimeout(() => {
                                $('.option_2_err' + (k)).text('');
                            }, 5000);
                            $('.option_2_err' + (k)).text('Option 2 can\'t be blank');

                            setTimeout(() => {
                                $('.option_3_err' + (k)).text('');
                            }, 5000);
                            $('.option_3_err' + (k)).text('Option 3 can\'t be blank');

                            setTimeout(() => {
                                $('.option_4_err' + (k)).text('');
                            }, 5000);
                            $('.option_4_err' + (k)).text('Option 4 can\'t be blank');

                            setTimeout(() => {
                                $('.answer_err' + (k)).text('');
                            }, 5000);
                            $('.answer_err' + (k)).text('Right answer can\'t be blank');

                        } else {
                            setTimeout(() => {
                                $('.option_1_err').text('');
                            }, 5000);
                            $('.option_1_err').text('Option 1 can\'t be blank');

                            setTimeout(() => {
                                $('.option_2_err').text('');
                            }, 5000);
                            $('.option_2_err').text('Option 2 can\'t be blank');

                            setTimeout(() => {
                                $('.option_3_err').text('');
                            }, 5000);
                            $('.option_3_err').text('Option 3 can\'t be blank');

                            setTimeout(() => {
                                $('.option_4_err').text('');
                            }, 5000);
                            $('.option_4_err').text('Option 4 can\'t be blank');

                            setTimeout(() => {
                                $('.answer_err').text('');
                            }, 5000);
                            $('.answer_err').text('Right answer can\'t be blank');

                        }
                        errorFlagOne = 1;
                    }

                }
            }
        }

        for (var i = 0; i < all_textarea.length; ++i) {
            let textarea_value = all_textarea[i].value;
            if (all_textarea[i].type === 'textarea') {
                if (all_textarea[i].value === '') {
                    if (k == 0) {
                        setTimeout(() => {
                            $('.textarea_error').text('');
                        }, 5000);
                        $('.textarea_error').text('Question filed can\'t be blank');
                    } else {
                        setTimeout(() => {
                            $('.textarea_error' + (k)).text('');
                        }, 5000);
                        $('.textarea_error' + (k)).text('Question filed can\'t be blank');
                    }
                    errorFlagOne = 1;
                }
                if (textarea_value.length > 500) {
                    setTimeout(() => {
                        $('.textarea_error').text('You can update a question within 500 characters');
                    }, 5000);
                    errorFlagOne = 1;
                }
            }
        }

        // End
        if (errorFlagOne == 1) {
            return false;
        } else {
            $('.mixed-question-form').submit();
        }

    });
</script>
