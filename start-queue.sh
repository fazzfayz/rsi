#!/bin/bash

# Start Laravel Queue Worker for Contact Form Optimization
# This script ensures emails are processed in the background

echo "🚀 Starting Laravel Queue Worker..."
echo "📧 Contact form emails will be processed in background"
echo "⏰ Started at: $(date)"
echo ""

# Start queue worker with optimized settings
php artisan queue:work \
    --queue=default \
    --timeout=60 \
    --tries=3 \
    --max-jobs=100 \
    --max-time=3600 \
    --memory=512 \
    --sleep=3 \
    --verbose

echo ""
echo "✅ Queue worker stopped at: $(date)" 