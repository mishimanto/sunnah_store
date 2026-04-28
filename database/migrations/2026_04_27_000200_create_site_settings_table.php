<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('site_name');
            $table->string('site_tagline')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('topbar_text')->nullable();
            $table->string('topbar_button_label')->nullable();
            $table->string('topbar_button_url')->nullable();
            $table->string('footer_newsletter_text')->nullable();
            $table->string('footer_copyright_text')->nullable();
            $table->string('footer_privacy_label')->nullable();
            $table->string('footer_privacy_url')->nullable();
            $table->string('blog_section_title')->nullable();
            $table->string('blog_section_subtitle')->nullable();
            $table->string('blog_search_placeholder')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
