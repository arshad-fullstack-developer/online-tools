<template>
    <div class="sitemap-generator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Automatically crawl and generate XML sitemap for your entire website</span>
        </div>

        <!-- Input Card -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-6 space-y-6">
                <!-- Website URL -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Website URL *</label>
                    <input
                        v-model="websiteUrl"
                        type="url"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                        placeholder="https://example.com or example.com"
                    />
                    <p class="text-xs text-gray-500 mt-1">Enter your website's domain - we'll automatically discover all pages</p>
                </div>

                <!-- Crawl Options -->
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                        Crawl Settings
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Max Pages to Crawl</label>
                            <input
                                v-model.number="maxPages"
                                type="number"
                                min="1"
                                max="1000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none"
                            />
                            <p class="text-xs text-gray-500 mt-1">Limit: 1-1000 pages (recommended: 100-500)</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <input 
                                v-model="includeImages" 
                                type="checkbox" 
                                id="images"
                                class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500"
                            />
                            <label for="images" class="text-sm font-medium text-gray-700 cursor-pointer">
                                Include image URLs in sitemap
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Change Frequency</label>
                        <select v-model="changeFreq" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none">
                            <option value="always">Always</option>
                            <option value="hourly">Hourly</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="never">Never</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Priority</label>
                        <select v-model="priority" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none">
                            <option value="1.0">1.0 (Highest)</option>
                            <option value="0.9">0.9</option>
                            <option value="0.8">0.8</option>
                            <option value="0.7">0.7</option>
                            <option value="0.6">0.6</option>
                            <option value="0.5">0.5 (Default)</option>
                            <option value="0.4">0.4</option>
                            <option value="0.3">0.3</option>
                            <option value="0.2">0.2</option>
                            <option value="0.1">0.1 (Lowest)</option>
                        </select>
                    </div>
                </div>

                <!-- Include Last Modified -->
                <div class="flex items-center space-x-3">
                    <input 
                        v-model="includeLastMod" 
                        type="checkbox" 
                        id="lastmod"
                        class="w-5 h-5 text-primary-600 rounded focus:ring-primary-500"
                    />
                    <label for="lastmod" class="text-sm font-medium text-gray-700 cursor-pointer">
                        Include last modification date (uses current date)
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 pt-4">
                    <button
                        @click="crawlAndGenerate"
                        :disabled="isCrawling"
                        class="flex-1 px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-bold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                    >
                        <svg v-if="!isCrawling" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                        </svg>
                        <svg v-else class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ isCrawling ? `Crawling... (${crawledCount}/${maxPages})` : 'Crawl & Generate Sitemap' }}
                    </button>
                    <button
                        @click="clear"
                        :disabled="isCrawling"
                        class="px-6 py-4 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all disabled:opacity-50"
                    >
                        Clear
                    </button>
                </div>

                <!-- Crawl Progress -->
                <div v-if="isCrawling" class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <div class="flex items-center mb-2">
                        <svg class="animate-spin h-5 w-5 text-yellow-600 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="font-semibold text-gray-900">Crawling website...</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div 
                            class="bg-gradient-to-r from-primary-600 to-primary-700 h-2 rounded-full transition-all duration-300"
                            :style="{ width: `${(crawledCount / maxPages) * 100}%` }"
                        ></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">Found {{ discoveredUrls.length }} unique URLs</p>
                </div>
            </div>
        </div>

        <!-- Result Card -->
        <div v-if="sitemap" class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-4 flex items-center justify-between">
                <h3 class="text-2xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Generated Sitemap
                </h3>
                <div class="flex space-x-2">
                    <button
                        @click="copySitemap"
                        class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition-colors flex items-center"
                    >
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path>
                            <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
                        </svg>
                        {{ copied ? 'Copied!' : 'Copy' }}
                    </button>
                    <button
                        @click="downloadSitemap"
                        class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition-colors flex items-center"
                    >
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Download
                    </button>
                </div>
            </div>

            <div class="p-6">
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Total URLs</div>
                        <div class="text-2xl font-bold text-blue-600">{{ urlCount }}</div>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">File Size</div>
                        <div class="text-2xl font-bold text-green-600">{{ fileSize }}</div>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Format</div>
                        <div class="text-2xl font-bold text-purple-600">XML</div>
                    </div>
                </div>

                <!-- Sitemap Preview -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-bold text-gray-900">sitemap.xml</h4>
                        <span class="text-xs text-gray-500">Preview</span>
                    </div>
                    <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto text-xs font-mono max-h-96 overflow-y-auto">{{ sitemap }}</pre>
                </div>

                <!-- Instructions -->
                <div class="mt-6 bg-blue-50 rounded-xl p-5">
                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        How to Use Your Sitemap
                    </h4>
                    <ol class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <span class="font-bold text-blue-600 mr-2">1.</span>
                            <span>Download the sitemap.xml file using the button above</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold text-blue-600 mr-2">2.</span>
                            <span>Upload it to your website's root directory (e.g., https://example.com/sitemap.xml)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold text-blue-600 mr-2">3.</span>
                            <span>Submit to Google Search Console: <a href="https://search.google.com/search-console" target="_blank" class="text-blue-600 underline">search.google.com/search-console</a></span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold text-blue-600 mr-2">4.</span>
                            <span>Submit to Bing Webmaster Tools: <a href="https://www.bing.com/webmasters" target="_blank" class="text-blue-600 underline">bing.com/webmasters</a></span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const websiteUrl = ref('');
const maxPages = ref(100);
const includeImages = ref(false);
const changeFreq = ref('weekly');
const priority = ref('0.5');
const includeLastMod = ref(true);
const sitemap = ref('');
const copied = ref(false);
const isCrawling = ref(false);
const crawledCount = ref(0);
const discoveredUrls = ref([]);

const urlCount = computed(() => {
    if (!sitemap.value) return 0;
    return (sitemap.value.match(/<url>/g) || []).length;
});

const fileSize = computed(() => {
    if (!sitemap.value) return '0 KB';
    const bytes = new Blob([sitemap.value]).size;
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
});

const crawlAndGenerate = async () => {
    if (!websiteUrl.value) {
        alert('Please enter a website URL');
        return;
    }

    // Clean and validate website URL
    let baseUrl = websiteUrl.value.trim();
    if (!baseUrl.startsWith('http://') && !baseUrl.startsWith('https://')) {
        baseUrl = 'https://' + baseUrl;
    }
    baseUrl = baseUrl.replace(/\/$/, ''); // Remove trailing slash

    isCrawling.value = true;
    crawledCount.value = 0;
    discoveredUrls.value = [];

    try {
        // Call backend API to crawl website
        const response = await axios.post('/api/crawl-sitemap', {
            url: baseUrl,
            max_pages: maxPages.value,
            include_images: includeImages.value,
        });

        discoveredUrls.value = response.data.urls || [];
        crawledCount.value = discoveredUrls.value.length;

        // Generate sitemap from discovered URLs
        generateSitemap(baseUrl, discoveredUrls.value);

        // Log usage
        axios.post(`/tools/${props.tool.slug}/log-usage`, {
            input: { url: baseUrl, max_pages: maxPages.value },
            result: { url_count: discoveredUrls.value.length, size: fileSize.value },
        }).catch(err => console.error(err));

    } catch (error) {
        console.error('Crawl error:', error);
        alert('Error crawling website. Please check the URL and try again. Note: Some websites may block crawling.');
    } finally {
        isCrawling.value = false;
    }
};

const generateSitemap = (baseUrl, urlList) => {
    // Get current date in ISO format
    const lastMod = new Date().toISOString().split('T')[0];

    // Generate XML
    let xml = '<?xml version="1.0" encoding="UTF-8"?>\n';
    xml += '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
    if (includeImages.value) {
        xml += '\n  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"';
    }
    xml += '>\n';

    urlList.forEach(urlData => {
        const url = typeof urlData === 'string' ? urlData : urlData.url;
        
        xml += '  <url>\n';
        xml += `    <loc>${escapeXml(url)}</loc>\n`;
        if (includeLastMod.value) {
            xml += `    <lastmod>${lastMod}</lastmod>\n`;
        }
        xml += `    <changefreq>${changeFreq.value}</changefreq>\n`;
        xml += `    <priority>${priority.value}</priority>\n`;
        
        // Add images if available
        if (includeImages.value && urlData.images && urlData.images.length > 0) {
            urlData.images.forEach(img => {
                xml += '    <image:image>\n';
                xml += `      <image:loc>${escapeXml(img)}</image:loc>\n`;
                xml += '    </image:image>\n';
            });
        }
        
        xml += '  </url>\n';
    });

    xml += '</urlset>';

    sitemap.value = xml;
};

const escapeXml = (str) => {
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&apos;');
};

const copySitemap = () => {
    navigator.clipboard.writeText(sitemap.value);
    copied.value = true;
    setTimeout(() => {
        copied.value = false;
    }, 2000);
};

const downloadSitemap = () => {
    const blob = new Blob([sitemap.value], { type: 'application/xml' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'sitemap.xml';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
};

const clear = () => {
    websiteUrl.value = '';
    maxPages.value = 100;
    includeImages.value = false;
    changeFreq.value = 'weekly';
    priority.value = '0.5';
    includeLastMod.value = true;
    sitemap.value = '';
    copied.value = false;
    crawledCount.value = 0;
    discoveredUrls.value = [];
};
</script>
