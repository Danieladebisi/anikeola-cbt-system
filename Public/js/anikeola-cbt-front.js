/**
 * Anikeola CBT System - Front-end Scripts
 * Version: 1.9
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        console.log('Localized Data:', anikeolaCbtData);

        $('.anikeola-cbt-exam-wrapper').each(function() {
            const $examWrapper = $(this);
            const examId = $examWrapper.data('exam-id');
            const $timerDisplay = $examWrapper.find('#anikeola-cbt-countdown-' + examId);
            const $examForm = $examWrapper.find('#anikeola-cbt-exam-form-' + examId);
            const $resultDisplay = $examWrapper.find('#anikeola-cbt-exam-result-' + examId);
            const $submitButton = $examWrapper.find('.anikeola-cbt-submit-button');
            let timerInterval; // To store the interval ID

            // --- Countdown Timer ---
            if ($timerDisplay.length) {
                let timeLeft = parseInt($timerDisplay.data('time-limit'), 10);
                
                if (isNaN(timeLeft) || timeLeft <= 0) {
                    $timerDisplay.text(anikeolaCbtData.text_times_up || '00:00:00');
                } else {
                    timerInterval = setInterval(function() {
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            $timerDisplay.text(anikeolaCbtData.text_times_up || 'Time\'s Up!');
                            // Auto-submit the form
                            $submitButton.text(anikeolaCbtData.text_time_expired_submitted || 'Time Expired - Submitting...').prop('disabled', true);
                            submitExam(); 
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

            // --- Answer Selection Visual Feedback (Optional Enhancement) ---
            $examForm.find('.anikeola-cbt-answer-options li input[type="radio"]').on('change', function() {
                $(this).closest('.anikeola-cbt-answer-options').find('li').removeClass('selected-answer');
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('selected-answer');
                }
            });

            // --- Function to handle exam submission ---
            function submitExam() {
                // Disable form elements to prevent multiple submissions
                $examForm.find('input, button').prop('disabled', true);
                $submitButton.text('Submitting...'); // Update button text

                const formData = $examForm.serializeArray();
                let answersData = {};
                // Reformat answers for easier processing on the backend
                $.each(formData, function(i, field) {
                    if (field.name.startsWith('answers[')) {
                        // Extract question ID from name="answers[QUESTION_ID]"
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
                        user_id: $examForm.find('input[name="user_id"]').val(), // Get user ID from hidden field
                        answers: answersData 
                    },
                    success: function(response) {
                        console.log('AJAX Response:', response);
                        if (response.success) {
                            let resultHtml = '<h3>' + (anikeolaCbtData.text_exam_submitted_header || 'Exam Results') + '</h3>';
                            resultHtml += '<p>' + (anikeolaCbtData.text_your_score_is || 'Your score:') + ' ' + response.data.score + ' / ' + response.data.total_questions + '</p>';
                            if(response.data.percentage !== undefined) {
                                resultHtml += '<p>' + (anikeolaCbtData.text_percentage || 'Percentage:') + ' ' + response.data.percentage + '%</p>';
                            }
                            if(response.data.passed !== undefined) {
                                resultHtml += '<p><strong>' + (response.data.passed ? (anikeolaCbtData.text_passed || 'Status: Passed') : (anikeolaCbtData.text_failed || 'Status: Failed')) + '</strong></p>';
                            }
                            // Add more details from response.data if needed (e.g., detailed feedback)
                            $resultDisplay.html(resultHtml).show();
                            $examForm.hide();
                            if ($timerDisplay.length) { 
                                clearInterval(timerInterval); // Stop timer if still running
                                $timerDisplay.hide(); 
                            }
                        } else {
                            $resultDisplay.html('<p class="error">' + (response.data.message || (anikeolaCbtData.text_error_submitting || 'Error submitting exam. Please try again.')) + '</p>').show();
                            $examForm.find('input, button').prop('disabled', false); // Re-enable form
                            $submitButton.text(anikeolaCbtData.text_submit_exam || 'Submit Exam');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $resultDisplay.html('<p class="error">' + (anikeolaCbtData.text_ajax_error || 'An AJAX error occurred:') + ' ' + textStatus + ' - ' + errorThrown + '</p>').show();
                        $examForm.find('input, button').prop('disabled', false); // Re-enable form
                        $submitButton.text(anikeolaCbtData.text_submit_exam || 'Submit Exam');
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

        }); // end .anikeola-cbt-exam-wrapper.each
    }); // end document.ready

})(jQuery);
