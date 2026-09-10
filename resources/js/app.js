import Swiper from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/effect-fade";

import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import Image from "@tiptap/extension-image";
import Link from "@tiptap/extension-link";
import TextAlign from "@tiptap/extension-text-align";
import Underline from "@tiptap/extension-underline";
import Highlight from "@tiptap/extension-highlight";
import Placeholder from "@tiptap/extension-placeholder";

window.Editor = Editor;
window.StarterKit = StarterKit;
window.TiptapImage = Image;
window.TiptapLink = Link;
window.TiptapTextAlign = TextAlign;
window.TiptapUnderline = Underline;
window.TiptapHighlight = Highlight;
window.TiptapPlaceholder = Placeholder;

window.setupEditor = function () {
    let editor;

    return {
        updatedAt: Date.now(),
        init(element) {
            const _this = this;

            editor = new window.Editor({
                element: element,
                extensions: [
                    window.StarterKit.configure({
                        heading: { levels: [1, 2, 3, 4, 5, 6] },
                    }),
                    window.TiptapImage.configure({ inline: true, allowBase64: false }),
                    window.TiptapLink.configure({ openOnClick: false }),
                    window.TiptapTextAlign.configure({ types: ['heading', 'paragraph'] }),
                    window.TiptapUnderline,
                    window.TiptapHighlight.configure({ multicolor: true }),
                    window.TiptapPlaceholder.configure({ placeholder: 'Tulis konten berita di sini...' }),
                ],
                content: this.content || '',
                editorProps: {
                    attributes: {
                        class: 'prose prose-sm dark:prose-invert max-w-none focus:outline-none min-h-[300px] p-4',
                    },
                },
                onCreate() {
                    _this.updatedAt = Date.now();
                },
                onUpdate({ editor: e }) {
                    _this.content = e.getHTML();
                    _this.updatedAt = Date.now();
                },
                onSelectionUpdate() {
                    _this.updatedAt = Date.now();
                },
            });
        },
        isLoaded() {
            void this.updatedAt;
            return !!editor;
        },
        isActive(type, opts = {}, _v) {
            void this.updatedAt;
            void _v;
            if (!editor) {
                return false;
            }
            return editor.isActive(type, opts);
        },
        toggleBold() {
            editor.chain().focus().toggleBold().run();
        },
        toggleItalic() {
            editor.chain().focus().toggleItalic().run();
        },
        toggleUnderline() {
            editor.chain().focus().toggleUnderline().run();
        },
        toggleStrike() {
            editor.chain().focus().toggleStrike().run();
        },
        toggleHighlight() {
            editor.chain().focus().toggleHighlight().run();
        },
        toggleHeading(opts) {
            editor.chain().focus().toggleHeading(opts).run();
        },
        setParagraph() {
            editor.chain().focus().setParagraph().run();
        },
        setAlign(value) {
            editor.chain().focus().setTextAlign(value).run();
        },
        toggleBulletList() {
            editor.chain().focus().toggleBulletList().run();
        },
        toggleOrderedList() {
            editor.chain().focus().toggleOrderedList().run();
        },
        toggleBlockquote() {
            editor.chain().focus().toggleBlockquote().run();
        },
        toggleCodeBlock() {
            editor.chain().focus().toggleCodeBlock().run();
        },
        undo() {
            editor.chain().focus().undo().run();
        },
        redo() {
            editor.chain().focus().redo().run();
        },
        addImage() {
            const url = window.prompt('Masukkan URL gambar:');
            if (url) {
                editor.chain().focus().setImage({ src: url }).run();
            }
        },
        insertImageUrl(url) {
            if (url) {
                editor.chain().focus().setImage({ src: url }).run();
            }
        },
        setLink() {
            const previousUrl = editor ? editor.getAttributes('link').href : '';
            const url = window.prompt('Masukkan URL link (kosongkan untuk hapus):', previousUrl || '');
            if (url === null) {
                return;
            }
            if (url === '') {
                editor.chain().focus().extendMarkRange('link').unsetLink().run();
                return;
            }
            editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
        },
    };
};

function initDestinationSwiper() {
    const el = document.querySelector(".destinations-swiper");

    if (!el) return;

    if (el.swiper) {
        el.swiper.destroy(true, true);
    }

    new Swiper(el, {
        modules: [Navigation, Pagination, Autoplay],

        slidesPerView: 1,

        spaceBetween: 16,

        loop: true,

        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },

        observer: true,
        observeParents: true,
        observeSlideChildren: true,

        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },

            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
            },

            1280: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
    });
}

function initHeroSwiper() {
    const hero = document.querySelector(".hero-swiper");

    if (!hero) return;

    if (hero.swiper) {
        hero.swiper.destroy(true, true);
    }

    const slideCount = hero.querySelectorAll(".swiper-slide").length;

    new Swiper(hero, {
        modules: [Pagination, Autoplay, EffectFade],

        slidesPerView: 1,

        effect: "fade",

        speed: 1200,

        loop: slideCount > 1,

        autoplay:
            slideCount > 1
                ? {
                      delay: 5500,
                      disableOnInteraction: false,
                  }
                : false,

        pagination: {
            el: hero.querySelector(".swiper-pagination"),
            clickable: true,
        },
    });
}

function initSwipers() {
    initDestinationSwiper();
    initHeroSwiper();
}

document.addEventListener("DOMContentLoaded", initSwipers);

document.addEventListener("livewire:navigated", () => {
    initSwipers();
});
