<?php
/**
 * Plugin Name: UH Government Communications — Initial publication
 * Description: Seeds editable professional pages once; never overwrites subsequent editor revisions.
 * Version: 1.0.0
 */
if (!defined('ABSPATH')) { exit; }

add_action('init', function () {
    if (get_option('uh_gcs_content_version') || !function_exists('wp_insert_post') || !is_blog_installed()) {
        return;
    }
    // Content is native WordPress material. Changes after launch belong to the authorised WP editor.
    $pages = [
        'home' => ['Home', <<<'HTML'
<h2>Welcome to Government Communications</h2>
<p>Government Communications is the professional home for people who work in communication across United Hampshire's Civil Service, departments, agencies and public bodies.</p>
<p>Find professional guidance, learning resources, information about communications careers and the standards that help ensure government communications are accurate, accessible, impartial and effective.</p>
HTML],
        'about' => ['About Government Communications', <<<'HTML'
<p><strong>We support all professional communicators across government to gain the skills and knowledge they need to carry out their roles.</strong></p>
<h2>Who we are</h2>
<p>The Government Communication Service is a Civil Service profession. If you are working in communications, or need communications advice or support as part of your role, the Service provides the central professional community, standards and guidance for government communicators.</p>
<p>Our profession is led through the Cabinet Office and works alongside communications teams in departments, agencies and public bodies. Departments remain responsible for their own policy and service communications, while No.10 Harrington Court is responsible for Chief Ministerial communications.</p>
<h2>What we do</h2>
<p>We help government communicators plan and deliver clear, effective communication by developing professional standards, sharing good practice, advising on propriety, building skills and supporting cross-government communication when coordinated activity is required.</p>
<p>The Government Communication Function, the Government Communications profession and GCS maintain related but distinct responsibilities: cross-government functional standards and coordination, professional development, and the central services needed to support communications work.</p>
<h2>Our role in government</h2>
<p>GCS is part of the Civil Service. The Cabinet Office provides professional leadership for central government communications, including strategy, evaluation, propriety, professional capability and coordination. This is not a separate ministerial department and does not replace departmental press offices or their ministerial accountability.</p>
<p><a href="https://www.gov.uhrblx.com/government/organisations/government-communication-service">Visit the official GOV.UH organisation profile</a>.</p>
HTML],
        'membership' => ['Membership', <<<'HTML'
<p><strong>Be part of a professional community.</strong> Membership of Government Communications is intended for people whose work includes the professional planning, production, delivery or evaluation of government communications.</p>
<h2>Who the profession supports</h2>
<p>Government Communications supports communicators working in central government departments, executive agencies and other public bodies, and in devolved administrations where the applicable professional arrangements provide for their participation.</p>
<h2>Professional benefits</h2>
<ul><li>Access to standards and practical guidance for government communications.</li><li>Opportunities to improve communications skills through reading and professional development.</li><li>Shared practice in campaign planning, media, digital communication, evaluation and accessibility.</li><li>Information about Civil Service careers and communications roles.</li></ul>
<h2>Professional responsibilities</h2>
<p>Communicators are expected to act with integrity, honesty, objectivity and impartiality in accordance with the Civil Service Code and the standards applicable to their organisation. Being part of the profession does not provide additional ministerial authority, technical permissions or access to classified government records.</p>
<h2>Joining and enquiries</h2>
<p>The relevant employer and Government Communication Service determine professional membership and access to internal services. For enquiries, use the <a href="https://www.gov.uhrblx.com/government/organisations/government-communication-service">GCS organisation profile on GOV.UH</a>. A professional website account does not substitute for employer verification or a separately authorised membership decision.</p>
HTML],
        'careers' => ['Careers in government communications', <<<'HTML'
<p><strong>Building careers in government communications.</strong> Government communication professionals help people understand public policy, public services, decisions and issues that affect their communities.</p>
<h2>What communications professionals do</h2>
<p>Roles can involve strategic communications, internal communication, media and press relations, campaigns, digital content, stakeholder engagement, audience research, evaluation, accessible content and public information during emergencies.</p>
<h2>How to start your career</h2>
<p>Explore advertised positions and their eligibility, skills and experience requirements. Departments and agencies remain responsible for the recruitment and appointment of their staff, applying Civil Service recruitment standards.</p>
<p><a href="https://civil-service-jobs.gov.uhrblx.com/">Search Civil Service Jobs in United Hampshire</a>.</p>
<h2>Developing your career</h2>
<p>Use professional standards and the practical guidance on this website to identify your development needs. Seek feedback, undertake relevant learning and apply what you have learnt through supervised work and professional practice.</p>
<p><a href="/learning/">Explore professional learning</a> and <a href="/standards/">read the standards</a>.</p>
HTML],
        'learning' => ['Learning and professional development', <<<'HTML'
<p><strong>Develop your knowledge and skills throughout your career.</strong> The Government Communication Service supports professional development through learning materials, guidance and shared practice for government communicators.</p>
<h2>Build a development plan</h2>
<p>Review your current responsibilities, identify the technical and professional skills you need, agree learning priorities with your manager where applicable, and put those skills into practice. Keep a record of the learning undertaken and reflect on improvements to your work.</p>
<h2>Learning areas</h2>
<ul>
<li><a href="/publication/communication-planning/">Communication planning</a> — setting objectives, understanding audiences and identifying the right approach.</li>
<li><a href="/publication/accessible-communication/">Accessible communication</a> — writing and publishing information that people can understand and use.</li>
<li><a href="/publication/evaluating-communications/">Evaluation</a> — assessing outputs, outcomes and the contribution of communications to policy or service objectives.</li>
<li><a href="/standards/">Professional standards</a> — ethics, propriety and accountability.</li>
</ul>
<h2>Learning in practice</h2>
<p>Communicators develop through formal training, supported practice, mentoring, feedback and learning from others. The specific programmes available to an individual depend on their employer, responsibilities and the learning provision established for that organisation.</p>
HTML],
        'standards' => ['Our professional standards', <<<'HTML'
<p><strong>Delivering effective, ethical and professional government communications.</strong> Everyone communicating on behalf of government must maintain public trust and meet the standards required of their role.</p>
<h2>How we work</h2>
<p>Government communications must be based on evidence, support legitimate government business and distinguish factual public information from political campaigning. Civil servants are bound by the Civil Service Code and the associated requirements of integrity, honesty, objectivity and impartiality.</p>
<h2>Planning and accountability</h2>
<p>Communications should have clear objectives, an identified public need, a responsible organisation and an accountable approver. The communications plan should consider audiences, channels, accessibility, budgets, risks, measurement, records retention and applicable professional or spending controls.</p>
<h2>Appropriate use of public resources</h2>
<p>Communications expenditure, official channels and public-service resources must be used only for authorised public purposes. Cabinet Office central communications advice does not transfer spending powers from LL Treasury, legal authority from the responsible institution or departmental responsibility from ministers and officials.</p>
<h2>Accessibility, information and privacy</h2>
<p>Information should be understandable and accessible. Collect, process, retain and publish personal information only under the applicable legal and administrative rules. Use approved publishing systems and preserve the authoritative government record.</p>
<h2>Professional support</h2>
<p>The Government Communication Service provides guidance, learning and specialist advice. Its standards and professional functions operate alongside the Civil Service Code, public-information requirements and the responsibilities of each department.</p>
<p><a href="/resources/">Browse practical professional resources</a>.</p>
HTML],
        'resources' => ['Resources and guidance', <<<'HTML'
<p><strong>Professional tools, guidance and insights.</strong> Use these resources to support government communications at every stage, from planning and production to publication and evaluation.</p>
<h2>Planning, delivery and measurement</h2><p><a href="/publication/">Browse all publications and guidance</a>.</p>
<ul><li><a href="/publication/communication-planning/">Plan a communication activity</a> — objectives, audiences, strategy, delivery and assessment.</li><li><a href="/publication/evaluating-communications/">Evaluate government communications</a> — record evidence, measure outcomes and improve delivery.</li><li><a href="/publication/accessible-communication/">Publish accessible communication</a> — content and format considerations for public information.</li></ul>
<h2>Professional conduct and capability</h2>
<ul><li><a href="/standards/">Government communications standards</a>.</li><li><a href="/learning/">Learning and professional development</a>.</li><li><a href="/careers/">Careers and recruitment routes</a>.</li></ul>
<h2>Official government material</h2>
<p>For departmental policy, operational procedures, government publications and services, use the responsible organisation's authoritative website and the <a href="https://www.gov.uhrblx.com/">GOV.UH</a> publication estate. Professional guidance on this site does not replace legislation or departmental operational instructions.</p>
HTML],
        'contact' => ['Contact Government Communications', <<<'HTML'
<p>The Government Communication Service provides professional guidance, standards and coordination for government communications.</p>
<h2>Government Communication Service enquiries</h2>
<p>For professional and organisational enquiries, consult the <a href="https://www.gov.uhrblx.com/government/organisations/government-communication-service">Government Communication Service's official GOV.UH profile</a> and the authorised Cabinet Office communications arrangements. Do not send sensitive personal information through an unverified email address or informal service.</p>
<h2>Press or departmental enquiries</h2>
<p>Departmental press offices remain responsible for communications concerning their departments. No.10 Harrington Court is responsible for Chief Ministerial communications. Contact the institution that owns the subject or service directly.</p>
<h2>Website feedback</h2><p>Use the responsible Government Communication Service contact route for accessibility problems, broken links or corrections to published professional information.</p>
HTML],
        'accessibility' => ['Accessibility statement', <<<'HTML'
<p>The Government Communication Service aims to make this website accessible to the widest possible audience.</p>
<h2>Using this website</h2>
<p>Pages use semantic headings, labelled search, visible keyboard focus, responsive layouts and text-based navigation. Users should be able to change their browser's text size or zoom without losing access to the main content.</p>
<h2>Known limitations</h2>
<p>Accessibility assessment is an ongoing responsibility. The publishing team must test new content, forms, media and document formats before release and address any barriers discovered.</p>
<h2>Reporting a problem</h2><p>Use the <a href="/contact/">contact guidance</a> to raise an accessibility issue with the responsible Government Communication Service team.</p>
HTML],
        'privacy' => ['Privacy and cookies', <<<'HTML'
<p>This website is published for the Government Communication Service and hosted within the authorised United Hampshire digital estate.</p>
<h2>Information about visits</h2><p>Web server records may include technical details needed to provide, protect and maintain the site. Do not provide personal or sensitive information through ordinary website search.</p>
<h2>Cookies</h2><p>WordPress authentication cookies are used when authorised publishers sign in to the content management system. Public information pages do not require a WordPress account. The site does not intentionally use advertising or third-party analytics cookies.</p>
<h2>Professional membership and recruitment</h2><p>Membership decisions and recruitment processes belong to their responsible systems. This public website does not independently process membership applications or job applications.</p>
<h2>More information</h2><p>See the responsible <a href="https://www.gov.uhrblx.com/government/organisations/government-communication-service">GCS organisation profile</a> and <a href="https://www.gov.uhrblx.com/">GOV.UH</a> information-rights publications.</p>
HTML],
        'news' => ['News', '']
    ];
    $ids = [];
    foreach ($pages as $slug => $entry) {
        $existing = get_page_by_path($slug);
        $ids[$slug] = $existing ? $existing->ID : wp_insert_post([
            'post_title' => $entry[0],
            'post_name' => $slug,
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => $entry[1],
            'comment_status' => 'closed',
        ], true);
        if (is_wp_error($ids[$slug])) return;
    }
    update_option('show_on_front', 'page');
    update_option('page_on_front', $ids['home']);
    update_option('page_for_posts', $ids['news']);
    update_option('blogname', 'Government Communications');
    update_option('blogdescription', 'Professional guidance, standards and learning for government communicators');
    update_option('default_comment_status', 'closed');
    update_option('users_can_register', 0);
    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules(false);
    update_option('uh_gcs_content_version', '2026-10-19-v1');
}, 99);
