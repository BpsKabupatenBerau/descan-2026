<style>
    :root {
        --descan-bg: #0f1726;
        --descan-panel: #1f2a38;
        --descan-panel-2: #253142;
        --descan-border: #334155;
        --descan-muted: #7d8796;
        --descan-green: #16843d;
        --descan-blue: #2563eb;
        --descan-red: #ef4444;
    }

    .fi-body,
    .fi-layout,
    .fi-main,
    .fi-simple-layout {
        background: var(--descan-bg) !important;
    }

    .fi-sidebar,
    .fi-topbar {
        background: var(--descan-panel) !important;
        border-color: rgba(255, 255, 255, .06) !important;
    }

    .fi-sidebar-nav-groups,
    .fi-sidebar-nav {
        gap: 18px;
    }

    .fi-sidebar-item-active > .fi-sidebar-item-button,
    .fi-sidebar-item-button:hover {
        background: var(--descan-green) !important;
        color: #fff !important;
        border-radius: 8px !important;
    }

    .fi-main-ctn {
        background: var(--descan-bg) !important;
    }

    .fi-header-heading,
    .fi-section-header-heading,
    .fi-ta-header-heading {
        color: #fff !important;
        letter-spacing: 0 !important;
    }

    .fi-section,
    .fi-ta-ctn,
    .fi-modal-window {
        background: var(--descan-panel) !important;
        border: 1px solid var(--descan-border) !important;
        border-radius: 16px !important;
        box-shadow: none !important;
    }

    .fi-section-header,
    .fi-ta-header {
        border-color: var(--descan-border) !important;
    }

    .fi-input-wrp,
    .fi-select-input,
    .fi-ta-search-field .fi-input-wrp,
    .fi-fo-file-upload,
    .fi-fo-tags-input {
        background: #3b4656 !important;
        border-color: #4b5565 !important;
        border-radius: 8px !important;
        color: #dbe3ef !important;
    }

    .fi-input,
    .fi-select-input,
    .fi-textarea {
        color: #dbe3ef !important;
    }

    .fi-input::placeholder,
    .fi-textarea::placeholder {
        color: #818b9b !important;
    }

    .fi-fo-field-wrp-label,
    .fi-fo-field-wrp-helper-text,
    .fi-breadcrumbs-item,
    .fi-ta-text,
    .fi-ta-header-cell {
        color: #9aa3b2 !important;
    }

    .fi-btn-color-primary {
        background: var(--descan-green) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
    }

    .fi-btn-color-gray {
        background: #3b4656 !important;
        border-radius: 8px !important;
    }

    .fi-ta-row,
    .fi-ta-table tbody tr {
        background: var(--descan-panel) !important;
    }

    .fi-ta-row:nth-child(even),
    .fi-ta-table tbody tr:nth-child(even) {
        background: var(--descan-panel-2) !important;
    }

    .fi-ta-table > :not(:last-child),
    .fi-ta-row,
    .fi-ta-cell {
        border-color: rgba(255, 255, 255, .06) !important;
    }

    .descan-page {
        color: #fff;
    }

    .descan-grid {
        display: grid;
        grid-template-columns: minmax(280px, 1fr) minmax(280px, 1fr);
        gap: 40px;
    }

    .descan-panel {
        background: var(--descan-panel);
        border: 1px solid var(--descan-border);
        border-radius: 16px;
        overflow: hidden;
    }

    .descan-panel-header {
        min-height: 48px;
        display: flex;
        align-items: center;
        gap: 16px;
        justify-content: space-between;
        padding: 0 16px;
        font-weight: 700;
        border-bottom: 1px solid rgba(59, 130, 246, .55);
    }

    .descan-count {
        color: #3b82f6;
        font-weight: 700;
    }

    .descan-add,
    .descan-primary-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 0 18px;
        color: #fff;
        background: var(--descan-green);
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
    }

    .descan-add-square {
        width: 32px;
        min-height: 40px;
        padding: 0;
        border-radius: 4px;
    }

    .descan-list {
        display: grid;
        gap: 8px;
    }

    .descan-card-row {
        min-height: 64px;
        display: grid;
        grid-template-columns: 48px 1fr auto auto;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        background: var(--descan-panel);
        border: 1px solid var(--descan-border);
        border-radius: 12px;
    }

    .descan-card-row-wide {
        min-height: 64px;
        grid-template-columns: 48px 1fr auto auto;
    }

    .descan-icon-dot {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        background: rgba(37, 99, 235, .22);
    }

    .descan-icon-dot::after {
        content: "";
        width: 18px;
        height: 18px;
        background: #05070b;
    }

    .descan-title {
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
    }

    .descan-subtitle {
        margin-top: 4px;
        color: var(--descan-muted);
        font-size: 12px;
    }

    .descan-badge {
        min-width: 60px;
        height: 24px;
        display: inline-grid;
        place-items: center;
        color: #0ea75a;
        background: #e9fff4;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
    }

    .descan-actions {
        display: flex;
        gap: 8px;
    }

    .descan-action {
        width: 32px;
        height: 24px;
        display: grid;
        place-items: center;
        border-radius: 6px;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
    }

    .descan-action-edit {
        background: rgba(37, 99, 235, .42);
    }

    .descan-action-edit::before {
        content: "";
        width: 12px;
        height: 12px;
        background: #3b82f6;
        border-radius: 2px;
    }

    .descan-action-delete {
        background: rgba(239, 68, 68, .35);
    }

    .descan-action-delete::before {
        content: "";
        width: 12px;
        height: 12px;
        background: var(--descan-red);
        border-radius: 2px;
    }

    .descan-table-panel {
        margin-top: 72px;
    }

    .descan-table {
        width: calc(100% - 56px);
        margin: 24px 28px 32px;
        border-collapse: collapse;
        color: #e5e7eb;
        border: 1px solid var(--descan-border);
    }

    .descan-table th,
    .descan-table td {
        height: 52px;
        padding: 0 16px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, .05);
    }

    .descan-table th {
        color: #7d8796;
        font-size: 12px;
    }

    .descan-table tr:nth-child(even) td {
        background: var(--descan-panel-2);
    }

    @media (max-width: 900px) {
        .descan-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .descan-card-row {
            grid-template-columns: 40px minmax(0, 1fr) auto auto;
            gap: 10px;
        }

        .descan-table {
            width: 100%;
            margin-inline: 0;
        }
    }
</style>
