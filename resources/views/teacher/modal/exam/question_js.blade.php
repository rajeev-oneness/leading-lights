<script>
    var i = 0;
    var k = 0;

    $(document).on("click", ".add_question_section", function() {
        var exam_id = $(this).data('id');
        $(".modal-body #exam_id").val(exam_id);
    });
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
            $('.textarea_error').text('');
            $("#dynamicAddRemove").append(`<hr>
        <div class="form-group">
        <label for="question">Question<span class="text-danger">*</span></label>
        <textarea type="text" name="addMoreInputFields[${i}][question]" class="form-control" cols="2" rows="2"></textarea>
        <span class="textarea_error${i} text-danger"></span>
        </div>
        <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" name="addMoreInputFields[${i}][image]" id="image">
        <span class="file_error${i} text-danger"></span>
        </div>
        `);
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
            $('.question-form').submit();
        }

    });

    // MCQ

    $("#dynamic-ar-mcq").click(function() {
        var errorFlagOne = 0;
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

            $("#dynamicAddRemoveMCQ").append(`<hr>
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
                    <label for=""><b>Right Answer<span class="text-danger">*</span></b></label>
                    <input type="text" name="addMoreInputFields[${i}][answer]" class="form-control">
                    <span class="answer_err${i} text-danger"></span>
                </div>
            </div>
        </div>
        `);
            ++i;
            ++k;
        }
    });

    $('#btn_mcq_submit').on('click', function(e) {
        e.preventDefault();
        // Start
        var errorFlagOne = 0;
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
</script>
