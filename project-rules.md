# Laravel 11 Project Constraints & Auditor Rules
You must strictly enforce these rules on all generated code.
## 1. Performance
- **Strict N+1 Prevention:** Explicitly use Eager Loading (`with()`) for Eloquent relationships.
## 2. Security (OWASP)
- **Data Validation:** Use dedicated Laravel `FormRequest` classes. Never use `$request->all()`.
- **XSS & CSRF:** Ensure `@csrf` is in all POST/PUT/DELETE forms. Use `{{ }}` for output.
## 3. Architecture
- **SOLID:** Keep Controllers thin. Route logic properly through Middleware (Admin vs User).
## 4. Documentation
- **Mandatory Docblocks:** All classes and methods MUST have PHPDoc comments.
- **Indonesian Language:** All code comments and internal explanations MUST be in professional Indonesian.
