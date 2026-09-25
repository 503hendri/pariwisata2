# DESIGN.md

## Identity & Personality
- **Identity:** Sawahlunto Tourism (Official Digital Tourism Portal).
- **Personality:** Heritage-focused, authoritative (UNESCO site), welcoming, premium-cultural (Gold/Green accents).

## Palette
- **Primary:** `coal-black` (#1C1C1C) - Base text, headers, navigation.
- **Accent:** `gold` (#C6A75E) - Primary CTAs, highlights, icons.
- **Secondary:** `forest-green` (#1F4D3B) - Section backgrounds, footer accents.
- **Neutral:** `zinc` series (#171717 to #fafafa), `stone-400` (secondary text).

## Typography
- **Headings:** "Playfair Display" (serif, bold 700). Used for major headers (`heading-font`).
- **Body:** "Inter" (sans-serif, 400-600). Used for layout body text (`tail-container`).
- **Utility:** "Instrument Sans" (configured in app.css).

## Dials (Energy / Rhythm / Motion)
- **ENERGY: 3** (Bold: one dominant focal point per screen, oversized serif headlines, gold accent used sparingly but decisively).
- **RHYTHM: 3** (Asymmetric: each section uses a distinct composition, not just a different background color. Grid, split, stagger, and timeline layouts alternate).
- **MOTION: 3** (Choreographed: staggered scroll reveal with varied delays, parallax scale on hero slides, consistent hover lift on cards).

> Guardrail (R-19): every technique at this dial must be listed in `resources/design/animation-purpose.md` with a one-line UX reason. No entry, no technique.

## Component Primitives
- **Button (`x-ds.button`):** Rounded-3xl, high-contrast variants (gold, dark, ghost, white).
- **Card (`x-ds.card`):** Rounded-3xl, overflow-hidden, consistent hover lift and gold border on hover.
- **Badge (`x-ds.badge`):** Rounded-full, uppercase tracking, tones gold/dark/light.
- **Section Header (`x-ds.section-header`):** Eyebrow + gold divider motif + serif title.
- **Empty State (`x-ds.empty-state`):** Standard R-27 fallback for every data-driven listing.

## Identity Motif
A short gold rule (`w-12 h-0.5 bg-[#C6A75E]`) under every section eyebrow, repeated site-wide, is the single recurring gesture that makes the UI belong to this product.
