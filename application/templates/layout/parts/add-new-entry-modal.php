<div id="add-new-entry-modal" class="reveal-modal">
    <a class="close-reveal-modal">&#215;</a>
    <h2><?php echo __('Add new entry') ?></h2>
    <form id="add-new-entry-form" class="custom">
        <input id="add-new-entry-child-id-input" type="hidden" name="child_id" value="0" /> 
        <div class="row">
            <div class="large-6 columns">
                <div class="row collapse">
                    <label for="add-new-entry-time-from-input"><?php echo __('Time from') ?> <small>(YYYY-MM-DD HH-MM:SS)</small>:</label>
                    <div class="small-9 columns">
                        <input id="add-new-entry-time-from-input" name="time_from" type="text" placeholder="2013-01-01 01:00:00" />
                    </div>
                    <div class="small-3 columns">
                        <button id="add-new-entry-time-from-now-button" class="button prefix"><?php echo __('Now') ?></button>
                    </div>
                </div>
                <div class="row collapse">
                    <label for="add-new-entry-time-to-input"><?php echo __('Time to') ?> <small>(YYYY-MM-DD HH-MM:SS)</small>:</label>
                    <div class="small-9 columns">
                        <input id="add-new-entry-time-to-input" name="time_to" type="text" placeholder="2013-02-01 01:00:00" />
                    </div>
                    <div class="small-3 columns">
                        <button id="add-new-entry-time-to-now-button" class="button prefix"><?php echo __('Now') ?></button>
                    </div>
                </div>
                <div>
                    <label for="add-new-entry-type-select"><?php echo __('Type') ?>:</label>
                    <select id="add-new-entry-type-select" name="type">
                        <option value="none">-- <?php echo __('select') ?> --</option>
                        <option value="measurement"><?php echo __('Measurement') ?></option>
                        <option value="symptom"><?php echo __('Symptom') ?></option>
                        <option value="medication"><?php echo __('Medication') ?></option>
                        <option value="activity"><?php echo __('Activity') ?></option>
                        <option value="food"><?php echo __('Food') ?></option>
                        <option value="disease"><?php echo __('Disease') ?></option>
                        <option value="event"><?php echo __('Event') ?></option>
                        <option value="other"><?php echo __('Other') ?></option>
                    </select>
                </div>
                <div>
                    <label for="add-new-entry-note-textarea"><?php echo __('Note') ?>:</label>
                    <textarea id="add-new-entry-note-textarea" name="note" rows="6"></textarea>
                </div>
                <div>
                    <label for="add-new-entry-mood-textarea"><?php echo __('Mood') ?>:</label>
                    <textarea id="add-new-entry-mood-textarea" name="mood" rows="6"><?php echo __('Normal') ?></textarea>
                </div>
            </div>
            <div class="large-6 columns">
                <div id="type-sections">
                    <h3><?php echo __('Details') ?></h3>
                    <div id="add-new-entry-none-section-fields" class="type-section-fields" style="display: block;">
                       <p><?php echo __('Please select a type first') ?></p>
                    </div>
                    <div id="add-new-entry-measurement-section-fields" class="type-section-fields">
                        <h4><?php echo __('Measurement') ?></h4>
                        <div class="row collapse">
                            <label for="add-new-entry-measurement-height-input"><?php echo __('Height') ?>:</label>
                            <div class="small-9 columns">
                                <input id="add-new-entry-measurement-height-input" name="measurement_height" type="text" />
                            </div>
                            <div class="small-3 columns">
                                <span class="postfix">cm</span>
                            </div>
                        </div>
                        <div class="row collapse">
                            <label for="add-new-entry-measurement-weight-input"><?php echo __('Weight') ?>:</label>
                            <div class="small-9 columns">
                                <input id="add-new-entry-measurement-weight-input" name="measurement_weight" type="text" />
                            </div>
                            <div class="small-3 columns">
                                <span class="postfix">kg</span>
                            </div>
                        </div>
                        <div class="row collapse">
                            <label for="add-new-entry-measurement-systolic-blood-pressure-input"><?php echo __('Systolic Blood Pressure') ?>:</label>
                            <div class="small-9 columns">
                                <input id="add-new-entry-measurement-systolic-blood-pressure-input" name="measurement_systolic_blood_pressure" type="text" />
                            </div>
                            <div class="small-3 columns">
                                <span class="postfix">mm Hg</span>
                            </div>
                        </div>
                        <div class="row collapse">
                            <label for="add-new-entry-measurement-diastolic-blood-pressure-input"><?php echo __('Diastolic Blood Pressure') ?>:</label>
                            <div class="small-9 columns">
                                <input id="add-new-entry-measurement-diastolic-blood-pressure-input" name="measurement_diastolic_blood_pressure" type="text" />
                            </div>
                            <div class="small-3 columns">
                                <span class="postfix">mm Hg</span>
                            </div>
                        </div>
                        <div class="row collapse">
                            <label for="add-new-entry-measurement-pulse-input"><?php echo __('Pulse') ?>:</label>
                            <div class="small-9 columns">
                                <input id="add-new-entry-measurement-pulse-input" name="measurement_pulse" type="text" />
                            </div>
                            <div class="small-3 columns">
                                <span class="postfix"><?php echo __('bpm') ?></span>
                            </div>
                        </div>
                        <div class="row collapse">
                            <label for="add-new-entry-measurement-fever-input"><?php echo __('Fever') ?>:</label>
                            <div class="small-9 columns">
                                <input id="add-new-entry-measurement-fever-input" name="measurement_fever" type="text" />
                            </div>
                            <div class="small-3 columns">
                                <span class="postfix">°C</span>
                            </div>
                        </div>
                    </div>
                    <div id="add-new-entry-symptom-section-fields" class="type-section-fields">
                        <h4><?php echo __('Symptom') ?></h4>
                        <div>
                            <label for="add-new-entry-symptom-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-symptom-what-input" name="symptom_what" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-symptom-pain-intensity-input"><?php echo __('Pain intensity') ?>:</label>
                            <input id="add-new-entry-symptom-pain-intensity-input" name="symptom_pain_intensity" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-symptom-where-input"><?php echo __('Where') ?>:</label>
                            <input id="add-new-entry-symptom-where-input" name="symptom_where" type="text" />
                        </div>
                    </div>
                    <div id="add-new-entry-medication-section-fields" class="type-section-fields">
                        <h4><?php echo __('Medication') ?></h4>
                        <div>
                            <label for="add-new-entry-medication-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-medication-what-input" name="medication_what" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-symptom-how-much-input"><?php echo __('How much') ?>:</label>
                            <input id="add-new-entry-symptom-how-much-input" name="medication_how_much" type="text" />
                        </div>
                    </div>
                    <div id="add-new-entry-activity-section-fields" class="type-section-fields">
                        <h4><?php echo __('Activity') ?></h4>
                        <div>
                            <label for="add-new-entry-activity-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-activity-what-input" name="activity_what" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-activity-intensity-input"><?php echo __('Intensity') ?>:</label>
                            <input id="add-new-entry-activity-intensity-input" name="activity_intensity" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-activity-calories-burned-input"><?php echo __('Calories burned') ?>:</label>
                            <input id="add-new-entry-activity-calories-burned-input" name="activity_calories_burned" type="text" />
                        </div>
                    </div>
                    <div id="add-new-entry-food-section-fields" class="type-section-fields">
                        <h4><?php echo __('Food') ?></h4>
                        <div>
                            <label for="add-new-entry-food-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-food-what-input" name="food_what" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-food-how-much-input"><?php echo __('How much') ?>:</label>
                            <input id="add-new-entry-food-how-much-input" name="food_how_much" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-food-calories-input"><?php echo __('Calories') ?>:</label>
                            <input id="add-new-entry-food-calories-input" name="food_calories" type="text" />
                        </div>
                    </div>
                    <div id="add-new-entry-disease-section-fields" class="type-section-fields">
                        <h4><?php echo __('Disease') ?></h4>
                        <div>
                            <label for="add-new-entry-disease-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-disease-what-input" name="disease_what" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-disease-symptoms-textarea"><?php echo __('Symptoms') ?>:</label>
                            <textarea id="add-new-entry-disease-symptoms-textarea" name="disease_symptoms"></textarea>
                        </div>
                        <div>
                            <label for="add-new-entry-disease-self-diagnosed-checkbox">
                                <input id="add-new-entry-disease-self-diagnosed-checkbox" name="disease_self_diagnosed" type="checkbox" style="display: none;">
                                <span class="custom checkbox"></span> 
                                <?php echo __('Self diagnosed') ?>
                            </label>
                        </div>
                        <div>
                            <label for="add-new-entry-disease-ongoing-checkbox">
                                <input id="add-new-entry-disease-ongoing-checkbox" name="disease_ongoing" type="checkbox" style="display: none;">
                                <span class="custom checkbox"></span> 
                                <?php echo __('Ongoing') ?>
                            </label>
                        </div>
                    </div>
                    <div id="add-new-entry-event-section-fields" class="type-section-fields">
                        <h4><?php echo __('Event') ?></h4>
                        <div>
                            <label for="add-new-entry-event-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-event-what-input" name="event_what" type="text" />
                        </div>
                        <div>
                            <label for="add-new-entry-event-details-textarea"><?php echo __('Details') ?>:</label>
                            <textarea id="add-new-entry-event-details-textarea" name="event_details"></textarea>
                        </div>
                    </div>
                    <div id="add-new-entry-other-section-fields" class="type-section-fields">
                        <h4><?php echo __('Other') ?></h4>
                        <div>
                            <label for="add-new-entry-other-what-input"><?php echo __('What') ?>:</label>
                            <input id="add-new-entry-other-what-input" name="other_what" type="text" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <button id="add-new-entry-save-entry-button" class="large button expand"><?php echo __('Save entry') ?></button>
            </div>
        </div>
    </form>
</div>