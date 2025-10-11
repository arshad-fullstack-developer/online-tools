# Contributing Guide

Thank you for considering contributing to the Dynamic Online Tools Platform! This document provides guidelines for contributing to the project.

## 🤝 How to Contribute

### Reporting Bugs

If you find a bug, please create an issue with:
- Clear title and description
- Steps to reproduce
- Expected vs actual behavior
- Screenshots if applicable
- Environment details (OS, PHP version, browser)

### Suggesting Features

Feature requests are welcome! Please include:
- Clear description of the feature
- Use case and benefits
- Possible implementation approach
- Mockups or examples if applicable

### Pull Requests

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Write/update tests if applicable
5. Commit your changes (`git commit -m 'Add amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

## 📝 Coding Standards

### PHP (Laravel)

- Follow PSR-12 coding standards
- Use type hints where possible
- Write descriptive variable and method names
- Add PHPDoc blocks for classes and methods
- Keep methods focused and single-purpose

Example:
```php
/**
 * Calculate the age from a given date.
 *
 * @param string $birthDate
 * @return array
 */
public function calculateAge(string $birthDate): array
{
    // Implementation
}
```

### JavaScript (Vue.js)

- Use ES6+ syntax
- Follow Vue.js style guide
- Use composition API for new components
- Keep components small and focused
- Use meaningful component and variable names

Example:
```vue
<script setup>
import { ref, computed } from 'vue';

const count = ref(0);
const doubleCount = computed(() => count.value * 2);
</script>
```

### CSS (TailwindCSS)

- Use Tailwind utility classes
- Create custom components in `app.css` when needed
- Follow mobile-first approach
- Keep styles consistent with existing design

## 🧪 Testing

### Running Tests

```bash
php artisan test
```

### Writing Tests

- Write tests for new features
- Update tests when modifying existing features
- Aim for good test coverage
- Test both happy paths and edge cases

## 🔧 Adding New Tools

### 1. Create Vue Component

Create `resources/js/Components/Tools/YourTool.vue`:

```vue
<template>
    <div class="space-y-6">
        <!-- Your tool UI -->
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

// Your tool logic
</script>
```

### 2. Register Component

Add import in `resources/js/Pages/Tools/Show.vue`:

```javascript
const YourTool = defineAsyncComponent(() => import('@/Components/Tools/YourTool.vue'));
```

### 3. Add to Component Map

```javascript
const components = {
    // ... existing components
    YourTool,
};
```

### 4. Create via Admin Panel

1. Login to admin panel
2. Navigate to Tools → Add New Tool
3. Fill in details:
   - Name: Your Tool Name
   - Component Name: YourTool
   - Category: Select appropriate category
   - Description, SEO fields, etc.
4. Save

### 5. Test Your Tool

- Visit the tool page
- Test all functionality
- Verify responsive design
- Check SEO meta tags

## 📚 Documentation

When adding features:
- Update README.md if needed
- Add inline code comments
- Update FEATURES.md for new features
- Create/update relevant documentation

## 🎨 Design Guidelines

### UI/UX Principles

- **Consistency**: Follow existing design patterns
- **Simplicity**: Keep interfaces clean and intuitive
- **Accessibility**: Ensure tools are accessible to all users
- **Responsiveness**: Test on mobile, tablet, and desktop
- **Performance**: Optimize for fast loading

### Color Palette

- Primary: `#0ea5e9` (Blue)
- Success: `#10b981` (Green)
- Warning: `#f59e0b` (Yellow)
- Danger: `#ef4444` (Red)
- Gray scale: Use Tailwind's gray palette

### Typography

- Font: Inter
- Headings: Bold, clear hierarchy
- Body: 16px base size
- Code: Monospace font

## 🔍 Code Review Process

All contributions go through code review:

1. **Automated Checks**: CI/CD runs tests and linters
2. **Peer Review**: At least one maintainer reviews
3. **Feedback**: Address review comments
4. **Approval**: Once approved, PR is merged

### Review Criteria

- Code quality and standards
- Test coverage
- Documentation
- Performance impact
- Security considerations
- Breaking changes

## 🚀 Release Process

### Versioning

We follow Semantic Versioning (SemVer):
- MAJOR: Breaking changes
- MINOR: New features (backward compatible)
- PATCH: Bug fixes

### Changelog

Update CHANGELOG.md with:
- New features
- Bug fixes
- Breaking changes
- Deprecations

## 💡 Development Tips

### Local Development

```bash
# Start development server
npm run dev

# In another terminal
php artisan serve
```

### Debugging

- Use Laravel Telescope for debugging (dev only)
- Check browser console for JS errors
- Review Laravel logs in `storage/logs/`
- Use Vue DevTools browser extension

### Database Changes

```bash
# Create migration
php artisan make:migration create_something_table

# Run migrations
php artisan migrate

# Rollback
php artisan migrate:rollback
```

### Clearing Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 📋 Commit Message Guidelines

Use clear, descriptive commit messages:

```
feat: Add password strength indicator
fix: Resolve word counter spacing issue
docs: Update installation guide
style: Format code according to PSR-12
refactor: Simplify age calculation logic
test: Add tests for discount calculator
chore: Update dependencies
```

### Commit Message Format

```
<type>: <subject>

<body>

<footer>
```

Types:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation
- `style`: Code style/formatting
- `refactor`: Code refactoring
- `test`: Tests
- `chore`: Maintenance

## 🤔 Questions?

If you have questions:
- Check existing documentation
- Search existing issues
- Create a new issue with the "question" label
- Join our community discussions

## 📜 Code of Conduct

### Our Pledge

We pledge to make participation in our project a harassment-free experience for everyone.

### Our Standards

- Be respectful and inclusive
- Accept constructive criticism
- Focus on what's best for the community
- Show empathy towards others

### Enforcement

Violations may result in:
- Warning
- Temporary ban
- Permanent ban

Report issues to project maintainers.

## 🎉 Recognition

Contributors will be:
- Listed in CONTRIBUTORS.md
- Mentioned in release notes
- Credited in documentation

Thank you for contributing! 🙏

---

**Happy Coding! 💻**
