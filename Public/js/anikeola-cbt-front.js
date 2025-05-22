/**
 * Anikeola CBT System - Front-end Scripts
 * Version: 1.8 (Matches plugin version where this file is first populated)
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

            // --- Countdown Timer ---
            if ($timerDisplay.length) {
                let timeLeft = parseInt($timerDisplay.data('time-limit'), 10);
                
                if (isNaN(timeLeft) || timeLeft <= 0) {
                    // No valid time limit or time is already up (e.g., if page was reloaded)
                    // You might want to hide the timer or show "Time's up!"
                    $timerDisplay.text('00:00:00');
                } else {
                    const timerInterval = setInterval(function() {
                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            $timerDisplay.text('Time\'s Up!');
                            // Auto-submit the form (basic for now, can be enhanced)
                            // alert('Time is up! Submitting your exam.');
                            // $examForm.submit(); // This would be a standard form submission
                            // For AJAX, you'd call your AJAX submission function here.
                            // For now, just disable inputs
                            $examForm.find('input, button').prop('disabled', true);
                            $examWrapper.find('.anikeola-cbt-submit-button').text('Time Expired - Submitted').addClass('disabled');

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
                // Remove 'selected-answer' class from all options in the same question
                $(this).closest('.anikeola-cbt-answer-options').find('li').removeClass('selected-answer');
                // Add 'selected-answer' class to the parent li of the checked radio
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('selected-answer');
                }
            });


            // --- Handle Exam Submission (Basic for now) ---
            $examForm.on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission for now

                // Collect answers (Example - will be used for AJAX later)
                const formData = $(this).serializeArray();
                console.log('Exam Submitted. Data:', formData); // For debugging
                
                // TODO: Implement AJAX submission to WordPress backend for processing
                // For now, just show a placeholder message and hide the form.

                // Example:
                // $.ajax({
                //     url: anikeolaCbtData.ajax_url, // Passed via wp_localize_script
                //     type: 'POST',
                //     data: {
                //         action: 'anikeola_cbt_submit_exam_answers', // PHP action hook
                //         nonce: anikeolaCbtData.nonce,
                //         exam_id: examId,
                //         answers: formData // Or process formData to send a cleaner structure
                //     },
                //     success: function(response) {
                //         // Assume response is JSON with score, feedback, etc.
                //         $resultDisplay.html('<h3>Results</h3><p>Your score: ' + response.score + '</p>').show();
                //         $examForm.hide();
                //         if ($timerDisplay.length) { $timerDisplay.hide(); }
                //     },
                //     error: function(errorThrown) {
                //         $resultDisplay.html('<p>Error submitting exam. Please try again.</p>').show();
                //         console.error('Error:', errorThrown);
                //     }
                // });

                // Placeholder action:
                $examForm.hide();
                if ($timerDisplay.length) { $timerDisplay.hide(); }
                $resultDisplay.html('<h3><?php esc_html_e( "Exam Submitted!", "anikeola-cbt" ); ?></h3><p><?php esc_html_e( "Your results will be processed. (Automatic result display coming soon).", "anikeola-cbt" ); ?></p>').show();
                alert('Exam Submitted! (Full processing and result display is the next step).');

            });

        }); // end .anikeola-cbt-exam-wrapper.each
    }); // end document.ready

})(jQuery);
