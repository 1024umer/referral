<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{Survey, SurveyQuestion, SurveyQuestionAnswer};

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Survey::create([
            'name' => 'Friday Challenge',
            'survey_id' => encrypt('Friday Challenge/1'),
            'is_active' => 1,
        ]);
        $survey = Survey::first();


        $questions = [
            [
                'survey_id' => $survey->id,
                'question' => 'Which of the following Windows 10 Enterprise features provides biometric identity access control?',
                'sortOrder' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What does IGA stand for?',
                'sortOrder' => 2,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is Authentication?',
                'sortOrder' => 3,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which of below is true about a qubit?',
                'sortOrder' => 4,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which of below is not a component of IGA?',
                'sortOrder' => 5,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'How do you handle MFA for service accounts?',
                'sortOrder' => 6,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is true of Identity Lifecycle Management (ILM)?',
                'sortOrder' => 7,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which is not a principle of Zero Trust?',
                'sortOrder' => 8,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is MFA bombing?',
                'sortOrder' => 9,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which is not a valid access control model?',
                'sortOrder' => 10,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What does ITDR stand for?',
                'sortOrder' => 11,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which of below is NOT something a user would provide to prove their identity?',
                'sortOrder' => 12,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is FedRamp?',
                'sortOrder' => 13,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is TOGAF?',
                'sortOrder' => 14,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'SwiftSlicer a data wiping malware was recently deployed using what?',
                'sortOrder' => 15,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which of the following types of access control uses fences, security policies, and security awareness training to stop unwanted or unauthorized activity from occurring?',
                'sortOrder' => 16,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'If you ask Microsoft’s Bing AI Chatbox > 15 questions what could happen?',
                'sortOrder' => 17,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is the primary purpose of Kerberos?',
                'sortOrder' => 18,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'In conflict what is best?',
                'sortOrder' => 19,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What of below did MIT Technology include in the list of 10 Breakthrough technologies of 2023?',
                'sortOrder' => 20,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is the best way to manage access policies?',
                'sortOrder' => 21,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Should you be skeptical about automating certificates?',
                'sortOrder' => 22,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which of below are potential challenges for service accounts?',
                'sortOrder' => 23,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is the core of security?',
                'sortOrder' => 24,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is the default RDP port?',
                'sortOrder' => 25,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is the purpose of Privileged Access Management (PAM)?',
                'sortOrder' => 26,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Active Directory & Azure AD correctly setup automated monitoring for privileged escalation & privileged access management helps',
                'sortOrder' => 27,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Which of below are potential attacks, tools or exposures against Active Directory?',
                'sortOrder' => 28,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is a benefit of JIT (Just in Time) or JEA (Just Enough Access)?',
                'sortOrder' => 29,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'In Linux file permissions what action does the letter “r” allow?',
                'sortOrder' => 30,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What technology enables users to access multiple applications and systems with a single set of login credentials?',
                'sortOrder' => 31,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'Where does the term “scrum” originate from?',
                'sortOrder' => 32,
            ],
            [
                'survey_id' => $survey->id,
                'question' => 'What is SCIM?',
                'sortOrder' => 33,
            ],
        ];
        $chunks = array_chunk($questions, 50);
        foreach ($chunks as $chunk) {
            SurveyQuestion::insert($chunk);
        }


        $answers = [
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 1,
                'answer' => 'Defender Antivirus',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 1,
                'answer' => 'Defender ATP',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 1,
                'answer' => 'Windows Hello',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 1,
                'answer' => 'Credential Guard',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 2,
                'answer' => 'Identity Governance and Administration',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 2,
                'answer' => 'I Get Angry',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 2,
                'answer' => 'Initial Governance Acceptance',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 2,
                'answer' => 'None of the Above',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 3,
                'answer' => 'Establishes Identity',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 3,
                'answer' => 'Validates Identity',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 3,
                'answer' => 'Assigns Access Rights',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 3,
                'answer' => 'Same as Authorization',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 4,
                'answer' => 'Can be 0 and 1 at the same time',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 4,
                'answer' => 'Cannot be copied',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 4,
                'answer' => 'Super position & entanglement are possible',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 4,
                'answer' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 5,
                'answer' => 'Identity LifeCycle Management/ILM',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 5,
                'answer' => 'Automation',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 5,
                'answer' => 'Single Sign On',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 5,
                'answer' => 'Governance',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 6,
                'answer' => 'Use certificate-based authentication',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 6,
                'answer' => 'Choose an on-prem MFA solution provider',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 6,
                'answer' => 'Who cares, service accounts are not important',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 6,
                'answer' => 'ITDR cant provide MFA to service accounts but can protect by blocking access in real time if high risk action is detected',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 7,
                'answer' => 'Includes usernames, IDs, job classes, workgroups & policies',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 7,
                'answer' => 'Initial onboarding, modification and de-boarding of identities',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 7,
                'answer' => 'Is hierarchical & maps entitlements to organizational groups & roles',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 7,
                'answer' => 'All of the Above',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 8,
                'answer' => 'Verify Explicitly',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 8,
                'answer' => 'Least Privilege',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 8,
                'answer' => 'Assume Breach',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 8,
                'answer' => 'Dont Worry. Be Happy',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 9,
                'answer' => 'Threat actor obtains valid credentials, then sends multiple authentication requests hoping to tire you out so you just push the button',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 9,
                'answer' => 'Cant talk about it',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 9,
                'answer' => 'Fear',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 9,
                'answer' => 'Chaos',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 10,
                'answer' => 'Discretionary Access Control (DAC)',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 10,
                'answer' => 'Role Based Access Control (RBAC)',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 10,
                'answer' => 'Mandatory Access Control (MAC)',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 10,
                'answer' => 'Cause Mom Said So Access Control (CMSS)',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 11,
                'answer' => 'Identity, Threat, Detection, Response',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 11,
                'answer' => 'Identity, Threat, Detection, Reasonable',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 11,
                'answer' => 'Identity, Tootsie, Detection, Response',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 11,
                'answer' => 'Identity, Threat, Death, Response',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 12,
                'answer' => 'Something they know',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 12,
                'answer' => 'Something they believe',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 12,
                'answer' => 'Something they have',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 12,
                'answer' => 'Something they are',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 13,
                'answer' => 'Federal Risk & Automation Management Program',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 13,
                'answer' => 'FISMA for cloud services',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 13,
                'answer' => 'Standard for accessing and authorizing cloud computing products and services',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 13,
                'answer' => 'All of the above',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 14,
                'answer' => '	The open group architecture framework',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 14,
                'answer' => '	Totally organic grass artificial flavor',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 14,
                'answer' => '	The only great artist forgotten',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 14,
                'answer' => '	The original goal framework',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 15,
                'answer' => '	GPO',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 15,
                'answer' => '	Kubernetes',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 15,
                'answer' => '	Likes',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 15,
                'answer' => '	None of the Above',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 16,
                'answer' => '	Preventive',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 16,
                'answer' => '	Detective',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 16,
                'answer' => '	Corrective',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 16,
                'answer' => '	Authoritative',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 17,
                'answer' => '	Emotional manipulation',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 17,
                'answer' => '	Asks to be called Sydney',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 17,
                'answer' => '	Hostility and anger',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 17,
                'answer' => '	All of the above',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 18,
                'answer' => '	Confidentiality',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 18,
                'answer' => '	Integrity',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 18,
                'answer' => '	Authentication',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 18,
                'answer' => '	Accountability',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 19,
                'answer' => '	Fight',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 19,
                'answer' => 'Flight',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 19,
                'answer' => '	All of the above',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 19,
                'answer' => '	None of the above. Seek different way of engaging',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 20,
                'answer' => '	James Webb Space Telescope',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 20,
                'answer' => '	Organs on Demand',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 20,
                'answer' => '	Ancient DNA analysis',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 20,
                'answer' => '	All of the above',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 21,
                'answer' => '	RBAC',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 21,
                'answer' => '	ABAC',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 21,
                'answer' => '	PBAC',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 21,
                'answer' => '	It does not matter',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 22,
                'answer' => '	Yes',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 22,
                'answer' => 'No',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 22,
                'answer' => '	Always think critically',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 23,
                'answer' => '	Not assigned to a specific user',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 23,
                'answer' => '	Worried about decommissioning & what could happen',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 23,
                'answer' => '	Service Account Sprawl',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 23,
                'answer' => 'All of the Above',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 24,
                'answer' => '	Identity',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 24,
                'answer' => '	Snakes',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 24,
                'answer' => '	Locks',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 24,
                'answer' => '	<Enter Your Value>',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 25,
                'answer' => '	443',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 25,
                'answer' => '	3389',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 25,
                'answer' => '53',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 25,
                'answer' => '22',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 26,
                'answer' => '	To provide access to all users',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 26,
                'answer' => '	Discovery & inventory of all privileged users including admin & service accounts, access controls, session monitoring, governance, centralized password policy to automate management of password lifecycle, endpoint privilege management',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 26,
                'answer' => '	Monitor all user activity',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 26,
                'answer' => '	To encrypt all data',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 27,
                'answer' => '	True',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 27,
                'answer' => '	False',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 27,
                'answer' => '	My head hurts make it stop',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 27,
                'answer' => '	None of the Above',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 28,
                'answer' => 'Something they know',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 28,
                'answer' => 'Something they believe',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 28,
                'answer' => 'Something they have',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 28,
                'answer' => 'Something they are',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 29,
                'answer' => '	Least Privileged, accountability, security, users get when they needed when they need it',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 29,
                'answer' => '	Increased complexity',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 29,
                'answer' => '	More to configure',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 29,
                'answer' => '	Life finds a way',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 30,
                'answer' => '	Read/Open',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 30,
                'answer' => '	Write',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 30,
                'answer' => '	Bleed',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 30,
                'answer' => '	Run',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 31,
                'answer' => '	Single Sign On (SSO)',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 31,
                'answer' => '	Multi-Factor Authentication (MFA)',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 31,
                'answer' => '	Identity Universe',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 31,
                'answer' => '	Cat Hurder',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 32,
                'answer' => '	Pond water',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 32,
                'answer' => '	Rugby',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 32,
                'answer' => '	Basement Stairs',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 32,
                'answer' => '	None of the Above',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 33,
                'answer' => '	System for cross domain identity management',
                'is_correct' => 1,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 33,
                'answer' => '	Sloths crossing invisible mountains',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 33,
                'answer' => '	Smart control for identity management',
                'is_correct' => 0,
            ],
            [
                'survey_id' => $survey->id,
                'survey_question_id' => 33,
                'answer' => '	Seamless collaboration for identity management',
                'is_correct' => 0,
            ],
        ];
        $ans = array_chunk($answers, 50);

        foreach ($ans as $an) {
            SurveyQuestionAnswer::insert($an);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Survey::truncate();
        SurveyQuestion::truncate();
        SurveyQuestionAnswer::truncate();
    }
};