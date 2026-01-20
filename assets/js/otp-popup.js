/**
 * OTP Verification Popup Flow - UI Only
 * Handles the step-by-step popup flow
 */

(function($) {
    'use strict';

    let currentStep = 1;
    let userRole = '';
    let phoneNumber = '';

    // Initialize on page load
    $(document).ready(function() {
        console.log('Initializing OTP Popup...');
        initOTPPopup();
        console.log('OTP Popup initialized');
        
        // Verify button exists
        if ($('#hb-role-continue').length) {
            console.log('Continue button found in DOM');
        } else {
            console.warn('Continue button NOT found in DOM');
        }
    });

    /**
     * Initialize OTP Popup
     */
    function initOTPPopup() {
        // Don't show popup on page load - it will be triggered by POD Gate Yes button
        // Keep popup hidden until explicitly called

        // Step 1: Enter Website
        $('#hb-enter-website').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            showStep(2);
            return false;
        });

        // Step 2: Proof of Delivery
        $('#hb-proof-yes').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            showStep(3);
            return false;
        });

        $('#hb-proof-no').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closePopup();
            return false;
        });

        // Step 3: Role Selection
        // Initialize with default selected role (Seller)
        userRole = $('input[name="user_role"]:checked').val() || 'seller';
        
        $('input[name="user_role"]').on('change', function() {
            userRole = $(this).val();
            $('#hb-role-continue').prop('disabled', false);
        });

        // Use event delegation to ensure handler works even if button is added dynamically
        $(document).on('click', '#hb-role-continue', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Continue button clicked, userRole:', userRole);
            
            // Ensure popup is visible
            const popup = $('#hb-otp-popup');
            if (!popup.is(':visible')) {
                popup.css('display', 'grid').css('opacity', '1').css('visibility', 'visible');
                document.body.style.overflow = "hidden";
            }
            
            // Ensure userRole is set from checked radio
            userRole = $('input[name="user_role"]:checked').val() || 'seller';
            console.log('Proceeding to step 4 with role:', userRole);
            
            if (userRole) {
                showStep(4);
                console.log('Step 4 should now be visible');
            } else {
                console.error('No userRole set, cannot proceed');
            }
            return false;
        });

        // Step 4: Phone Number Input
        $('#hb-phone-number').on('input', function() {
            phoneNumber = $(this).val().replace(/\D/g, ''); // Remove non-digits
            $(this).val(phoneNumber);
            
            const isValid = phoneNumber.length === 10;
            $('#hb-send-otp').prop('disabled', !isValid);
            
            // Clear message
            $('#hb-phone-message').removeClass('error success info').text('');
            
            if (phoneNumber.length > 0 && phoneNumber.length < 10) {
                showMessage('hb-phone-message', 'Please enter a 10-digit mobile number', 'error');
            }
        });

        $('#hb-send-otp').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (phoneNumber.length === 10) {
                // TODO: Call Twilio API to send OTP
                showMessage('hb-phone-message', 'OTP sent successfully!', 'success');
                setTimeout(function() {
                    showStep(5);
                }, 1000);
            } else {
                showMessage('hb-phone-message', 'Please enter a valid 10-digit mobile number', 'error');
            }
            return false;
        });

        // Try Again button - goes back to role selection
        $('#hb-try-again').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            // Clear phone number input
            $('#hb-phone-number').val('');
            phoneNumber = '';
            $('#hb-send-otp').prop('disabled', true);
            showMessage('hb-phone-message', '', '');
            // Go back to role selection (Step 3)
            showStep(3);
            return false;
        });

        // Step 5: OTP Verification
        setupOTPInputs();

        $('#hb-verify-otp').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const otp = getOTPValue();
            if (otp.length === 6) {
                // TODO: Verify OTP with backend
                showStep(6);
                
                // Simulate verification (UI only)
                setTimeout(function() {
                    // Redirect to My Account page
                    window.location.href = '/my-account/';
                }, 2000);
            } else {
                showMessage('hb-otp-message', 'Please enter the complete 6-digit OTP', 'error');
            }
            return false;
        });

        $('#hb-resend-otp').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            // TODO: Resend OTP via Twilio
            clearOTPInputs();
            showMessage('hb-otp-message', 'OTP resent successfully!', 'success');
            return false;
        });

        // Close popup
        $('.hb-popup-close').on('click', function() {
            closePopup();
        });

        // Close on overlay click
        $('#hb-otp-popup').on('click', function(e) {
            if ($(e.target).hasClass('hb-popup-overlay')) {
                closePopup();
            }
        });
    }

    /**
     * Show specific step
     */
    function showStep(step) {
        console.log('showStep called with step:', step);
        // Hide all steps
        $('.hb-popup-step').hide();
        
        // Show current step
        const stepElement = $('#hb-step-' + step);
        if (stepElement.length) {
            stepElement.show();
            console.log('Step', step, 'is now visible');
        } else {
            console.error('Step element #hb-step-' + step + ' not found');
        }
        
        currentStep = step;
        
        // If showing role selection step, ensure userRole is set and continue button is enabled
        if (step === 3) {
            userRole = $('input[name="user_role"]:checked').val() || 'seller';
            $('#hb-role-continue').prop('disabled', false);
        }
        
        // Focus on first input if available
        setTimeout(function() {
            if (step === 4) {
                $('#hb-phone-number').focus();
                console.log('Focused on phone number input');
            } else if (step === 5) {
                $('#hb-otp-1').focus();
            }
        }, 100);
    }

    /**
     * Close popup
     */
    function closePopup() {
        $('#hb-otp-popup').fadeOut(300);
        document.body.style.overflow = "";
    }

    /**
     * Show message
     */
    function showMessage(elementId, message, type) {
        const $element = $('#' + elementId);
        $element.removeClass('error success info').addClass(type).text(message);
        
        if (type === 'success' || type === 'info') {
            setTimeout(function() {
                $element.removeClass('error success info').text('');
            }, 3000);
        }
    }

    /**
     * Setup OTP input fields
     */
    function setupOTPInputs() {
        const otpInputs = $('.hb-otp-input');
        
        otpInputs.on('input', function() {
            const value = $(this).val().replace(/\D/g, '');
            $(this).val(value);
            
            // Auto-focus next input
            if (value && $(this).index() < otpInputs.length - 1) {
                otpInputs.eq($(this).index() + 1).focus();
            }
            
            // Enable verify button when all fields filled
            const otp = getOTPValue();
            $('#hb-verify-otp').prop('disabled', otp.length !== 6);
        });

        // Handle backspace
        otpInputs.on('keydown', function(e) {
            if (e.key === 'Backspace' && !$(this).val() && $(this).index() > 0) {
                otpInputs.eq($(this).index() - 1).focus();
            }
        });

        // Handle paste
        otpInputs.first().on('paste', function(e) {
            e.preventDefault();
            const pastedData = (e.originalEvent.clipboardData || window.clipboardData).getData('text');
            const digits = pastedData.replace(/\D/g, '').substring(0, 6);
            
            digits.split('').forEach(function(digit, index) {
                if (index < otpInputs.length) {
                    otpInputs.eq(index).val(digit);
                }
            });
            
            // Focus last filled input or verify button
            if (digits.length === 6) {
                $('#hb-verify-otp').focus();
            } else if (digits.length > 0) {
                otpInputs.eq(digits.length).focus();
            }
        });
    }

    /**
     * Get OTP value from all inputs
     */
    function getOTPValue() {
        let otp = '';
        $('.hb-otp-input').each(function() {
            otp += $(this).val();
        });
        return otp;
    }

    /**
     * Clear OTP inputs
     */
    function clearOTPInputs() {
        $('.hb-otp-input').val('');
        $('#hb-verify-otp').prop('disabled', true);
        $('#hb-otp-1').focus();
    }

    // Expose functions globally if needed
    window.hbOTPPopup = {
        show: function(step) {
            const popup = $('#hb-otp-popup');
            popup.css('display', 'flex').hide().fadeIn(300);
            document.body.style.overflow = "hidden";
            if (step && step >= 1 && step <= 6) {
                showStep(step);
            } else {
                showStep(1);
            }
        },
        showRoleSelection: function() {
            const popup = $('#hb-otp-popup');
            popup.css('display', 'flex').hide().fadeIn(300);
            document.body.style.overflow = "hidden";
            showStep(3);
        },
        close: function() {
            closePopup();
            document.body.style.overflow = "";
        }
    };

})(jQuery);
