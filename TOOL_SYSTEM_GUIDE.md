# 🛠️ Hybrid Tool System - Complete Guide

## 📋 Overview

Your platform now supports **TWO types of tools**:

1. **Template-Based Tools** (90% of tools) - No coding required
2. **Custom Component Tools** (10% of tools) - For advanced features

---

## ✅ What's Been Implemented

### 1. Database Structure
- ✅ `tool_type` field - Defines tool type (calculator, converter, text-tool, custom)
- ✅ `configuration` field - JSON configuration for template tools

### 2. Template Components
- ✅ **CalculatorTool.vue** - For all calculator tools
- ✅ **ConverterTool.vue** - For unit converters
- ✅ **TextTool.vue** - For text manipulation tools

### 3. Universal Renderer
- ✅ **UniversalToolRenderer.vue** - Automatically renders tools based on type

---

## 🎯 How to Create Tools

### Option 1: Calculator Tool (BMI, Age, Percentage, etc.)

**Example: BMI Calculator**

1. Go to `/admin/tools/create`
2. Fill in basic details:
   - **Name:** BMI Calculator
   - **Slug:** bmi-calculator
   - **Description:** Calculate your Body Mass Index
   - **Category:** Health & Fitness
   - **Tool Type:** `calculator`

3. **Configuration (JSON):**
```json
{
  "fields": [
    {
      "name": "weight",
      "label": "Weight",
      "type": "number",
      "placeholder": "Enter weight",
      "required": true,
      "min": 1,
      "max": 500,
      "help": "Enter your weight in kilograms"
    },
    {
      "name": "height",
      "label": "Height",
      "type": "number",
      "placeholder": "Enter height",
      "required": true,
      "min": 0.5,
      "max": 3,
      "step": 0.01,
      "help": "Enter your height in meters"
    }
  ],
  "formula": "weight / (height * height)",
  "unit": "kg/m²",
  "decimals": 2,
  "autoCalculate": false,
  "interpretation": [
    {
      "min": 0,
      "max": 18.5,
      "text": "Underweight - Consider consulting a healthcare professional"
    },
    {
      "min": 18.5,
      "max": 25,
      "text": "Normal weight - You're in a healthy range!"
    },
    {
      "min": 25,
      "max": 30,
      "text": "Overweight - Consider a balanced diet and exercise"
    },
    {
      "min": 30,
      "max": 100,
      "text": "Obese - Please consult a healthcare professional"
    }
  ]
}
```

---

### Option 2: Converter Tool (Length, Weight, Temperature, etc.)

**Example: Length Converter**

**Tool Type:** `converter`

**Configuration:**
```json
{
  "units": [
    {
      "value": "m",
      "label": "Meters",
      "formula": 1
    },
    {
      "value": "km",
      "label": "Kilometers",
      "formula": 0.001
    },
    {
      "value": "cm",
      "label": "Centimeters",
      "formula": 100
    },
    {
      "value": "mm",
      "label": "Millimeters",
      "formula": 1000
    },
    {
      "value": "mi",
      "label": "Miles",
      "formula": 0.000621371
    },
    {
      "value": "yd",
      "label": "Yards",
      "formula": 1.09361
    },
    {
      "value": "ft",
      "label": "Feet",
      "formula": 3.28084
    },
    {
      "value": "in",
      "label": "Inches",
      "formula": 39.3701
    }
  ],
  "decimals": 4,
  "showTable": true
}
```

---

### Option 3: Text Tool (Word Counter, Case Converter, etc.)

**Example: Case Converter**

**Tool Type:** `text-tool`

**Configuration:**
```json
{
  "operation": "uppercase",
  "inputLabel": "Enter Text",
  "placeholder": "Type or paste your text here...",
  "buttonLabel": "Convert to Uppercase",
  "autoProcess": false
}
```

**Available Operations:**
- `uppercase` - Convert to UPPERCASE
- `lowercase` - Convert to lowercase
- `titlecase` - Convert To Title Case
- `reverse` - Reverse text
- `remove-spaces` - Remove all spaces
- `remove-extra-spaces` - Remove extra spaces
- `remove-line-breaks` - Remove line breaks
- `sort-lines` - Sort lines alphabetically
- `remove-duplicates` - Remove duplicate lines

---

## 📝 More Calculator Examples

### Age Calculator
```json
{
  "fields": [
    {
      "name": "birthdate",
      "label": "Birth Date",
      "type": "date",
      "required": true
    }
  ],
  "formula": "(new Date() - new Date(birthdate)) / (365.25 * 24 * 60 * 60 * 1000)",
  "unit": "years",
  "decimals": 1
}
```

### Percentage Calculator
```json
{
  "fields": [
    {
      "name": "value",
      "label": "Value",
      "type": "number",
      "required": true
    },
    {
      "name": "total",
      "label": "Total",
      "type": "number",
      "required": true
    }
  ],
  "formula": "(value / total) * 100",
  "unit": "%",
  "decimals": 2
}
```

### Discount Calculator
```json
{
  "fields": [
    {
      "name": "price",
      "label": "Original Price",
      "type": "number",
      "required": true,
      "min": 0
    },
    {
      "name": "discount",
      "label": "Discount Percentage",
      "type": "number",
      "required": true,
      "min": 0,
      "max": 100
    }
  ],
  "formula": "price - (price * discount / 100)",
  "unit": "$",
  "decimals": 2
}
```

---

## 🔧 Next Steps

### To Complete the System:

1. **Run Migration:**
```bash
php artisan migrate
```

2. **Update Tool Model** (Already done ✅)

3. **Test Creating a Tool:**
   - Go to `/admin/tools/create`
   - Create a BMI Calculator using the example above
   - Visit `/tools/bmi-calculator` to test

---

## 🚀 Future: Advanced Tools

For tools like **Image Background Removal**, **PDF Converter**, etc.:

1. Create custom component: `resources/js/Components/Tools/Custom/BackgroundRemover.vue`
2. In admin, set:
   - **Tool Type:** `custom`
   - **Component Name:** `BackgroundRemover`
3. The UniversalToolRenderer will load your custom component

---

## 📊 Summary

**You can now create:**
- ✅ Any calculator (BMI, Age, Loan, Tip, etc.)
- ✅ Any converter (Length, Weight, Temperature, Currency)
- ✅ Any text tool (Word Counter, Case Converter, etc.)
- ✅ Custom tools (for advanced features)

**All without writing code - just configure JSON!** 🎉
