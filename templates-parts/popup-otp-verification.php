<?php
/**
 * OTP Verification Popup Flow
 * UI Only - No backend integration yet
 */
?>

<!-- OTP Verification Popup Container -->
<div id="hb-otp-popup" class="hb-popup-overlay" style="display: none;">
    <div class="hb-popup-container">
        <span class="hb-popup-close">&times;</span>
        
        <!-- Step 1: Enter Website -->
        <div id="hb-step-1" class="hb-popup-step">
            <div class="hb-popup-content">
                <h2>Welcome to HumanBlockchain</h2>
                <p>Click below to enter the website</p>
                <button type="button" class="hb-btn-primary" id="hb-enter-website">Enter Website</button>
            </div>
        </div>

        <!-- Step 2: Proof of Delivery Question -->
        <div id="hb-step-2" class="hb-popup-step" style="display: none;">
            <div class="hb-popup-content">
                <h2>Is this a proof of delivery?</h2>
                <div class="hb-button-group">
                    <button type="button" class="hb-btn-primary" id="hb-proof-yes">Yes</button>
                    <button type="button" class="hb-btn-secondary" id="hb-proof-no">No</button>
                </div>
            </div>
        </div>

        <!-- Step 3: Role Selection -->
        <div id="hb-step-3" class="hb-popup-step" style="display: none;">
            <div class="hb-popup-content">
                <h2>What is your role?</h2>
                <div class="hb-role-selection">
                    <label class="hb-role-option" for="hb-role-seller">
                        <input type="radio" name="user_role" value="seller" id="hb-role-seller" checked>
                        <span>Seller</span>
                    </label>
                    <label class="hb-role-option" for="hb-role-buyer">
                        <input type="radio" name="user_role" value="buyer" id="hb-role-buyer">
                        <span>Buyer</span>
                    </label>
                </div>
                <div class="hb-button-group">
                    <button type="button" class="hb-btn-primary" id="hb-role-continue">Continue</button>
                </div>
            </div>
        </div>

        <!-- Step 4: Mobile Number Input -->
        <div id="hb-step-4" class="hb-popup-step" style="display: none;">
            <div class="hb-popup-content">
                <h2>Enter Your Mobile Number</h2>
                <div class="hb-phone-input-group">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" id="hb-phone-number" name="phone_number" placeholder="Enter 10-digit mobile number" maxlength="10" pattern="\d*" inputmode="numeric">
                </div>
                <div class="hb-form-message" id="hb-phone-message"></div>
                <div class="hb-button-group">
                    <button type="button" class="hb-btn-primary" id="hb-send-otp" disabled>Send OTP</button>
                    <button type="button" class="hb-btn-secondary" id="hb-try-again">Try Again</button>
                </div>
            </div>
        </div>

        <!-- Step 5: OTP Verification -->
        <div id="hb-step-5" class="hb-popup-step" style="display: none;">
            <div class="hb-popup-content">
                <h2>Enter OTP</h2>
                <p class="hb-otp-instruction">We've sent a 6-digit code to your mobile number</p>
                <div class="hb-otp-input-group" id="hb-otp-container">
                    <input type="text" id="hb-otp-1" class="hb-otp-input" maxlength="1" pattern="\d*" inputmode="numeric">
                    <input type="text" id="hb-otp-2" class="hb-otp-input" maxlength="1" pattern="\d*" inputmode="numeric">
                    <input type="text" id="hb-otp-3" class="hb-otp-input" maxlength="1" pattern="\d*" inputmode="numeric">
                    <input type="text" id="hb-otp-4" class="hb-otp-input" maxlength="1" pattern="\d*" inputmode="numeric">
                    <input type="text" id="hb-otp-5" class="hb-otp-input" maxlength="1" pattern="\d*" inputmode="numeric">
                    <input type="text" id="hb-otp-6" class="hb-otp-input" maxlength="1" pattern="\d*" inputmode="numeric">
                </div>
                <div class="hb-form-message" id="hb-otp-message"></div>
                <div class="hb-otp-actions">
                    <button type="button" class="hb-btn-primary" id="hb-verify-otp" disabled>Verify OTP</button>
                    <button type="button" class="hb-btn-link" id="hb-resend-otp">Resend OTP</button>
                </div>
            </div>
        </div>

        <!-- Step 6: Loading/Verifying -->
        <div id="hb-step-6" class="hb-popup-step" style="display: none;">
            <div class="hb-popup-content">
                <div class="hb-loading-spinner"></div>
                <p>Verifying...</p>
            </div>
        </div>
    </div>
</div>
