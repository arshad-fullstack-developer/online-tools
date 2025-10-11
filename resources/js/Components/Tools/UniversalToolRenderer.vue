<template>
    <div class="universal-tool-renderer">
        <!-- Calculator Type -->
        <CalculatorTool 
            v-if="tool.tool_type === 'calculator'" 
            :tool="tool" 
            :configuration="configuration"
        />

        <!-- Converter Type -->
        <ConverterTool 
            v-else-if="tool.tool_type === 'converter'" 
            :tool="tool" 
            :configuration="configuration"
        />

        <!-- Text Tool Type -->
        <TextTool 
            v-else-if="tool.tool_type === 'text-tool'" 
            :tool="tool" 
            :configuration="configuration"
        />

        <!-- Custom Component (fallback) -->
        <component 
            v-else
            :is="getCustomComponent(tool.component_name)" 
            :tool="tool" 
        />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import CalculatorTool from './Templates/CalculatorTool.vue';
import ConverterTool from './Templates/ConverterTool.vue';
import TextTool from './Templates/TextTool.vue';

const props = defineProps({
    tool: {
        type: Object,
        required: true,
    },
});

const configuration = computed(() => {
    if (typeof props.tool.configuration === 'string') {
        try {
            return JSON.parse(props.tool.configuration);
        } catch (e) {
            return {};
        }
    }
    return props.tool.configuration || {};
});

const getCustomComponent = (componentName) => {
    // Dynamically import custom components
    const components = import.meta.glob('./Custom/*.vue', { eager: true });
    const componentPath = `./Custom/${componentName}.vue`;
    return components[componentPath]?.default || null;
};
</script>
