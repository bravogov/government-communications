<?php
/**
 * Plugin Name: Government Communications — Publications and topics
 * Description: Editable publication content type, topics, filtering and canonical resource routes.
 * Version: 1.0.0
 */
if (!defined('ABSPATH')) { exit; }

add_action('init', function () {
    register_post_type('gcs_publication', [
        'labels' => [
            'name' => 'Publications',
            'singular_name' => 'Publication',
            'add_new_item' => 'Add publication',
            'edit_item' => 'Edit publication',
        ],
        'public' => true,
        'show_in_rest' => true,
        'show_ui' => true,
        'has_archive' => 'publication',
        'rewrite' => ['slug' => 'publication', 'with_front' => false],
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor', 'excerpt', 'revisions', 'author', 'thumbnail'],
        'map_meta_cap' => true,
    ]);
    register_taxonomy('gcs_topic', ['gcs_publication'], [
        'labels' => ['name' => 'Topics', 'singular_name' => 'Topic'],
        'public' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'topic'],
    ]);
    register_taxonomy('gcs_resource_type', ['gcs_publication'], [
        'labels' => ['name' => 'Resource types', 'singular_name' => 'Resource type'],
        'public' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'hierarchical' => false,
        'rewrite' => ['slug' => 'resource-type'],
    ]);
}, 5);

add_action('init', function () {
    if (!is_blog_installed() || get_option('uh_gcs_publications_seed_v1')) return;

    // Professional website resource titles correspond to the UK product architecture.
    // These are ordinary editorial guides, not new Cabinet Office standards or legal rules.
    $resources = [
        [
            'title' => 'Communication planning',
            'summary' => 'Plan government communications around a clear purpose, audience insight and measurable objectives.',
            'topic' => 'Strategy and planning',
            'content' => '<p>Communication should support an identified government policy, service or public-information need. Before beginning activity, establish the purpose, the intended audience, the organisation responsible and the authority for publication.</p><h2>Objectives</h2><p>Set out the outcome sought, and identify how communications can contribute to that outcome. Distinguish the policy or service objective from the communication activity itself.</p><h2>Audience and insight</h2><p>Use available evidence to understand the audiences who need information, the barriers they face and the channels through which they can be reached. Consider accessibility and the needs of people who do not use the principal digital platforms.</p><h2>Strategy and ideas</h2><p>Develop a clear message and choose a proportionate approach. Record the channels, content, responsibilities, approvals, timing, risks and resources.</p><h2>Implementation</h2><p>Check accuracy, propriety and accessibility before publication. Use the responsible organisation’s approved publishing system, retain the authorisation record and coordinate with other government communicators where necessary.</p><h2>Scoring and evaluation</h2><p>Agree evidence and measures before activity begins. Review what changed, identify what was effective and use the findings to improve future communications.</p>',
        ],
        [
            'title' => 'Evaluating communications',
            'summary' => 'Measure the effects of government communications and use the evidence to improve future work.',
            'topic' => 'Evaluation and insight',
            'content' => '<p>Evaluation is essential to understanding whether communications have achieved their objectives and provided value for public resources.</p><h2>Plan from the beginning</h2><p>Start with the objectives of the communication activity and decide what evidence will show whether they were achieved. Explain how communication is expected to contribute to policy or service outcomes.</p><h2>Measurement</h2><p>Assess outputs such as publication and reach, audience understanding, and relevant outcomes. Use proportionate methods including feedback, research and appropriate service statistics.</p><h2>Reporting results</h2><p>Record the evidence, explain relevant limitations and identify other factors that may have influenced the result. Findings should support professional learning and decisions about subsequent activity.</p>',
        ],
        [
            'title' => 'Accessible communications',
            'summary' => 'Make information clear, inclusive and accessible to the people who need it.',
            'topic' => 'Accessibility and inclusion',
            'content' => '<p>Government communicators should plan accessibility from the start of every activity. Public information must be presented in ways that people can find, understand and use.</p><h2>Plan for your audience</h2><p>Consider people with disabilities, cognitive and communication needs, different levels of literacy, and those who cannot use particular channels.</p><h2>Write and publish clearly</h2><p>Use plain English, meaningful headings and descriptive links. Provide text alternatives for informative images and accessible formats for documents and media. Use approved institutional publishing systems.</p><h2>Test and improve</h2><p>Check keyboard accessibility, mobile layouts, contrast and screen-reader compatibility. Gather feedback, correct barriers and keep accessibility under review.</p>',
        ],
        [
            'title' => 'Propriety and ethics in government communications',
            'summary' => 'Apply Civil Service impartiality and the standards of professional government communication.',
            'topic' => 'Propriety and ethics',
            'content' => '<p>Government communications must be accurate, objective and impartial, and must be undertaken for proper government purposes. Civil servants are expected to comply with the Civil Service Code and the obligations applying to their work.</p><h2>Professional conduct</h2><p>Check the evidence supporting factual claims, distinguish official information from political comment and avoid inappropriate use of public resources. Apply the relevant authorisation and spending controls.</p><h2>Getting advice</h2><p>The GCS Propriety and Ethics team supports departmental Directors and Heads of Communication and provides specialist advice on communications matters. Departments retain their responsibilities and the wider Cabinet Office propriety arrangements remain distinct.</p>',
        ],
    ];

    foreach ($resources as $resource) {
        $slug = sanitize_title($resource['title']);
        $post = get_page_by_path($slug, OBJECT, 'gcs_publication');
        if (!$post) {
            $id = wp_insert_post([
                'post_type' => 'gcs_publication',
                'post_status' => 'publish',
                'post_title' => $resource['title'],
                'post_name' => $slug,
                'post_excerpt' => $resource['summary'],
                'post_content' => $resource['content'],
                'comment_status' => 'closed',
            ], true);
            if (is_wp_error($id)) return;
        } else {
            $id = $post->ID;
        }
        wp_set_object_terms($id, $resource['topic'], 'gcs_topic', false);
        wp_set_object_terms($id, 'Guidance', 'gcs_resource_type', false);
    }

    update_option('uh_gcs_publications_seed_v1', '2026-10-19');
    flush_rewrite_rules(false);
}, 95);
