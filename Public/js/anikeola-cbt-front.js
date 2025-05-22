/**
 * Anikeola CBT System - Front-end Scripts
 * Version: 2.2 (Enhanced UI & Progress Bar)
 */
(function($) {
    'use strict';

    $(document).ready(function() {

        $('.anikeola-cbt-exam-wrapper').each(function() {
            const $examWrapper = $(this);
            const examId = $examWrapper.data('exam-id');
            const $timerDisplay = $examWrapper.find('#anikeola-cbt-countdown-' + examId);
            const $examForm = $examWrapper.find('#anikeola-cbt-exam-form-' + examId);
            const $resultDisplay = $examWrapper.find('#anikeola-cbt-exam-result-' + examId);
            const $submitButton = $examWrapper.find('.anikeola-cbt-submit-button');
            let timerInterval; 

            const $questions = $examForm.find('.anikeola-cbt-question');
            const totalQuestions = $questions.length;
            const $progressContainer = $examWrapper.find('.anikeola-cbt-progress-container');
            const $progressBar = $examWrapper.find('.anikeola-cbt-progress-bar');
            const $progressText = $examWrapper.find('.anikeola-cbt-progress-text');

            // --- Function to update Progress Bar ---
            function updateProgressBar() {
                if (!$progressBar.length || !$progressText.length) return;

                let answeredQuestions = 0;
                $questions.each(function() {
                    if ($(this).find('input[type="radio"]:checked').length > 0) {
                        answeredQuestions++;
                    }
                });

                const progressPercentage = totalQuestions > 0 ? (answeredQuestions / totalQuestions) * 100 : 0;
                $progressBar.css('width', progressPercentage + '%');
                $progressText.text(answeredQuestions + ' / ' + totalQuestions + ' Answered');
            }
            
            // Initial progress bar update
            if (totalQuestions > 0) {
                 updateProgressBar();
            } else {
                if ($progressContainer.length) $progressContainer.hide(); // Hide progress if no questions
            }


            // --- Countdown Timer ---
            if ($timerDisplay.length) {
                let timeLeft = parseInt($timerDisplay.data('time-limit'), 10);
                
                if (isNaN(timeLeft) || timeLeft <= 0) {
                    $timerDisplay.text(anikeolaCbtData.text_times_up || '00:00:00');
                     if ($progressContainer.length) $progressContainer.hide(); // Hide progress if time is up initially
                } else {
                    timerInterval = setInterval(function() {
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            $timerDisplay.text(anikeolaCbtData.text_times_up || 'Time\'s Up!');
                            $submitButton.text(anikeolaCbtData.text_time_expired_submitted || 'Time Expired - Submitting...').prop('disabled', true).addClass('disabled');
                            submitExam(true); 
                        } else {
                            timeLeft--;
                            const hours = Math.floor(timeLeft / 3600);
                            const minutes = Math.floor((timeLeft % 3600) / 60);
                            const seconds = timeLeft % 60;
                            
                            $timerDisplay.text(
                                (hours < 10 ? '0' : '') + hours + ':' +
                                (minutes < 10 ? '0' : '') + minutes + ':' +
                                (seconds < 10 ? '0' : '') + seconds
                            );
                        }
                    }, 1000);
                }
            }

            // --- Answer Selection Visual Feedback & Progress Update ---
            $examForm.find('.anikeola-cbt-answer-options li input[type="radio"]').on('change', function() {
                const $currentQuestionOptions = $(this).closest('.anikeola-cbt-answer-options');
                $currentQuestionOptions.find('li').removeClass('selected-answer');
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('selected-answer');
                }
                updateProgressBar(); // Update progress when an answer is selected
            });

            // --- Function to handle exam submission ---
            function submitExam(isAutoSubmit = false) {
                if ($submitButton.prop('disabled') && !isAutoSubmit) return; 

                $examForm.find('input, button').prop('disabled', true);
                $submitButton.text('Submitting...').addClass('disabled');

                const formData = $examForm.serializeArray();
                let answersData = {};
                $.each(formData, function(i, field) {
                    if (field.name.startsWith('answers[')) {
                        const qIdMatch = field.name.match(/answers\[(\d+)\]/);
                        if (qIdMatch && qIdMatch[1]) {
                            answersData[qIdMatch[1]] = field.value;
                        }
                    }
                });

                $.ajax({
                    url: anikeolaCbtData.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'anikeola_cbt_submit_exam_answers',
                        nonce: anikeolaCbtData.nonce,
                        exam_id: examId,
                        user_id: $examForm.find('input[name="user_id"]').val(),
                        answers: answersData 
                    },
                    beforeSend: function() {
                        // You could add a more prominent loading spinner here
                    },
                    success: function(response) {
                        $examForm.slideUp(400); 
                        if ($timerDisplay.length) { 
                            clearInterval(timerInterval); 
                            // $timerDisplay.slideUp(300); // Keep timer visible with "Time's Up" or hide progress
                            if ($progressContainer.length) $progressContainer.slideUp(300);
                        }

                        if (response.success) {
                            let resultHtml = '<h3>' + (anikeolaCbtData.text_exam_submitted_header || 'Exam Results') + '</h3>';
                            resultHtml += '<p>' + (anikeolaCbtData.text_your_score_is || 'Your score:') + ' ' + response.data.score + ' / ' + response.data.total_questions + '</p>';
                            if(response.data.percentage !== undefined) {
                                resultHtml += '<p>' + (anikeolaCbtData.text_percentage || 'Percentage:') + ' ' + response.data.percentage + '%</p>';
                            }
                            if(response.data.passed !== undefined) {
                                resultHtml += '<p><strong>' + (response.data.passed ? (anikeolaCbtData.text_passed || 'Status: Passed') : (anikeolaCbtData.text_failed || 'Status: Failed')) + '</strong></p>';
                            }
                            $resultDisplay.html(resultHtml).fadeIn(500); 
                        } else {
                            $resultDisplay.html('<p class="error">' + (response.data.message || (anikeolaCbtData.text_error_submitting || 'Error submitting exam. Please try again.')) + '</p>').fadeIn(500);
                            if (!isAutoSubmit) {
                                $examForm.find('input, button').prop('disabled', false);
                                $submitButton.text(anikeolaCbtData.text_submit_exam || 'Submit Exam').removeClass('disabled');
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $resultDisplay.html('<p class="error">' + (anikeolaCbtData.text_ajax_error || 'An AJAX error occurred:') + ' ' + textStatus + ' - ' + errorThrown + '</p>').fadeIn(500);
                         if (!isAutoSubmit) {
                            $examForm.find('input, button').prop('disabled', false);
                            $submitButton.text(anikeolaCbtData.text_submit_exam || 'Submit Exam').removeClass('disabled');
                        }
                        console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
                    }
                });
            }

            // --- Handle Exam Submission on Button Click ---
            $examForm.on('submit', function(e) {
                e.preventDefault(); 
                if (confirm(anikeolaCbtData.text_confirm_submission || 'Are you sure you want to submit your exam?')) {
                    submitExam();
                }
            });

            // --- Question Entry Animation (if CSS is set up for it) ---
            // The CSS already handles this with `animation: questionFadeIn`
            // If more complex JS-driven entry animations are needed, they'd go here.
            // For example, to trigger animations as user scrolls or for one-by-one display.

        }); // end .anikeola-cbt-exam-wrapper.each
    }); // end document.ready

})(jQuery);
