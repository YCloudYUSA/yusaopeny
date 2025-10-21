---
name: Bug Report
about: Report a bug or unexpected behavior in the distribution
title: "[BUG] "
labels: ["bug", "needs-triage"]
assignees: ""
---

# Bug Report: [Brief Description]

**Owner**: @[github-username]
**Type**: Bug / Defect
**Severity**: [Critical / High / Medium / Low]
**Priority**: [P0 / P1 / P2 / P3]
**Status**: Needs Triage

---

## 🐛 Bug Description

### Summary

[Clear and concise description of the bug]

### Impact

**Affected Users**: [Number or percentage of users affected]

**User Impact**:
- [ ] Blocks critical functionality
- [ ] Degrades user experience
- [ ] Minor inconvenience
- [ ] Visual/cosmetic issue only

**Business Impact**:
- [ ] Data loss/corruption
- [ ] Performance degradation
- [ ] Security vulnerability
- [ ] None

---

## 📋 Steps to Reproduce

### Prerequisites

[Any setup or conditions required before reproduction]

### Reproduction Steps

1. [First step]
2. [Second step]
3. [Third step]
4. [Continue...]

### Expected Behavior

[What should happen]

### Actual Behavior

[What actually happens]

---

## 🖼️ Evidence

<details>
<summary><strong>📸 Screenshots/Videos (Click to expand)</strong></summary>

[Add screenshots or screen recordings here]

**Screenshot 1**: [Description]
![Screenshot](url-to-image)

</details>

<details>
<summary><strong>📊 Error Messages/Logs (Click to expand)</strong></summary>

**Console Errors**:
```
[Paste error messages here]
```

**Drupal Watchdog Logs**:
```
[Paste watchdog logs here]
```

**PHP Errors**:
```
[Paste PHP error logs here]
```

**Stack Trace**:
```
[Paste stack trace here]
```

</details>

---

## 🔧 Environment

### System Information

<details>
<summary><strong>💻 Environment Details (Click to expand)</strong></summary>

**Distribution Version**: [e.g., 11.1.0.0]

**Drupal Core Version**: [e.g., 11.1.0]

**PHP Version**: [e.g., 8.3.0]

**Database**: [e.g., MySQL 8.0, MariaDB 10.6, PostgreSQL 15]

**Web Server**: [e.g., Apache 2.4, Nginx 1.24]

**Browser** (if applicable):
- Name: [e.g., Chrome, Firefox, Safari, Edge]
- Version: [e.g., 119.0.6045.105]
- Operating System: [e.g., macOS 14.1, Windows 11, Ubuntu 22.04]

**Device** (if mobile):
- Type: [e.g., iPhone 15 Pro, Samsung Galaxy S23]
- OS version: [e.g., iOS 17.2, Android 14]
- Screen size: [e.g., 390x844]

**Development Environment** (if applicable):
- [ ] DDEV
- [ ] Lando
- [ ] Docker
- [ ] Native LAMP/LEMP
- [ ] Other: _____

</details>

---

## 🔍 Root Cause Analysis

<details>
<summary><strong>🔬 Technical Investigation (Click to expand)</strong></summary>

### Suspected Cause

[Initial hypothesis about what's causing the bug]

### Affected Components

- [ ] Frontend/Theme
- [ ] Backend/Module
- [ ] Configuration
- [ ] Database
- [ ] Third-party integration
- [ ] Other: _____

### Related Code

**Module**: `[module_name]`
**File**: `[path/to/file.php]`
**Line**: [123]

```php
// Code snippet showing the problematic area
```

### Database Queries

```sql
-- Problematic query (if applicable)
```

</details>

---

## 🛠️ Proposed Solution

<details>
<summary><strong>💡 Fix Strategy (Click to expand)</strong></summary>

### Recommended Fix

[Describe the proposed solution]

### Alternative Approaches

1. **Approach 1**: [Description]
   - Pros: [List]
   - Cons: [List]

2. **Approach 2**: [Description]
   - Pros: [List]
   - Cons: [List]

### Code Changes Required

**Files to modify**:
- `[file1.php]` - [What needs to change]
- `[file2.php]` - [What needs to change]

**Update Hooks Needed**: [Yes/No]
- [ ] `hook_update_N` for upgrade path

**Estimated Effort**: [Hours or Story Points]

</details>

---

## ✅ Acceptance Criteria

### Definition of Done

- [ ] Bug reproduced and root cause identified
- [ ] Fix implemented and code reviewed
- [ ] Unit/kernel tests added or updated
- [ ] Manual testing completed
- [ ] Update hooks added (if needed for upgrade path)
- [ ] Documentation updated (if needed)
- [ ] Code follows [Drupal coding standards](https://www.drupal.org/docs/develop/standards)
- [ ] Tested on supported Drupal versions
- [ ] Change record created (if API change)

### Test Cases

<details>
<summary><strong>🧪 Test Scenarios (Click to expand)</strong></summary>

#### Test Case 1: [Scenario Name]
**Given**: [Initial conditions]
**When**: [Action taken]
**Then**: [Expected result]
**Status**: [ ] Pass / [ ] Fail

#### Test Case 2: [Scenario Name]
**Given**: [Initial conditions]
**When**: [Action taken]
**Then**: [Expected result]
**Status**: [ ] Pass / [ ] Fail

</details>

---

## 🔗 Related Issues & References

### Related Items

- Duplicate of: #[issue-number]
- Related to: #[issue-number]
- Introduced in: #[PR-number]
- Blocks: #[issue-number]

### External References

- [Drupal.org issue link (if applicable)]
- [Stack Overflow thread]
- [External bug report]

---

## ⚠️ Workaround

<details>
<summary><strong>🚧 Temporary Workaround (Click to expand)</strong></summary>

[If a workaround exists, describe it here]

**Steps**:
1. [Workaround step 1]
2. [Workaround step 2]

**Limitations**:
- [Limitation 1]
- [Limitation 2]

</details>

---

## 🔄 Regression Prevention

### Changes Needed

- [ ] Add unit/kernel test to prevent regression
- [ ] Add functional test
- [ ] Update existing tests
- [ ] Add update hooks for data migration
- [ ] Improve error handling
- [ ] Add validation

---

## 📝 Additional Context

[Any additional information, context, or notes]

---

## ✅ Triage Checklist (for maintainers)

- [ ] Bug is reproducible
- [ ] Severity assigned
- [ ] Priority assigned
- [ ] Impact assessed
- [ ] Owner assigned
- [ ] Added to milestone
- [ ] Workaround documented (if available)

---

**Template Version**: 1.0
**Source**: ITCare GitHub Templates
**Last Updated**: 2025-10-21
