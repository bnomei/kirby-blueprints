<?php

namespace Bnomei\Blueprints\Schema;

enum Icon: string
{
    case ACCESSIBILITY = 'accessibility';
    case ACCOUNT = 'account';
    case ADD = 'add';
    case AI = 'ai';
    case ALERT = 'alert';
    case ANCHOR = 'anchor';
    case ANGLE_DOWN = 'angle-down';
    case ANGLE_LEFT = 'angle-left';
    case ANGLE_RIGHT = 'angle-right';
    case ANGLE_UP = 'angle-up';
    case ARCHIVE = 'archive';
    case ASTERIX = 'asterix';
    case ATTACHMENT = 'attachment';
    case AUDIO = 'audio';
    case BADGE = 'badge';
    case BARS = 'bars';
    case BELL = 'bell';
    case BLANK = 'blank';
    case BOLD = 'bold';
    case BOLT = 'bolt';
    case BOOK = 'book';
    case BOOKMARK = 'bookmark';
    case BOX = 'box';
    case BRUSH = 'brush';
    case BUG = 'bug';
    case CALENDAR = 'calendar';
    case CANCEL = 'cancel';
    case CANCEL_SMALL = 'cancel-small';
    case CAR = 'car';
    case CART = 'cart';
    case CHART = 'chart';
    case CHAT = 'chat';
    case CHECK = 'check';
    case CHECKLIST = 'checklist';
    case CIRCLE = 'circle';
    case CIRCLE_FILLED = 'circle-filled';
    case CIRCLE_HALF = 'circle-half';
    case CIRCLE_NESTED = 'circle-nested';
    case CIRCLE_OUTLINE = 'circle-outline';
    case CLEAR = 'clear';
    case CLOCK = 'clock';
    case CLOUD = 'cloud';
    case CODE = 'code';
    case COG = 'cog';
    case COLLAPSE = 'collapse';
    case COLLAPSE_HORIZONTAL = 'collapse-horizontal';
    case COPY = 'copy';
    case CREDIT_CARD = 'credit-card';
    case CROP = 'crop';
    case DASHBOARD = 'dashboard';
    case DISCORD = 'discord';
    case DISCOUNT = 'discount';
    case DISPLAY = 'display';
    case DIVIDER = 'divider';
    case DOCUMENT = 'document';
    case DOTS = 'dots';
    case DOWNLOAD = 'download';
    case DRAFT = 'draft';
    case EDIT = 'edit';
    case EDIT_LINE = 'edit-line';
    case EMAIL = 'email';
    case EXPAND = 'expand';
    case EXPAND_HORIZONTAL = 'expand-horizontal';
    case FACEBOOK = 'facebook';
    case FILE = 'file';
    case FILE_AUDIO = 'file-audio';
    case FILE_CODE = 'file-code';
    case FILE_DOCUMENT = 'file-document';
    case FILE_IMAGE = 'file-image';
    case FILE_SPREADSHEET = 'file-spreadsheet';
    case FILE_TEXT = 'file-text';
    case FILE_VIDEO = 'file-video';
    case FILE_WORD = 'file-word';
    case FILE_ZIP = 'file-zip';
    case FILTER = 'filter';
    case FLAG = 'flag';
    case FOLDER = 'folder';
    case FOLDER_STRUCTURE = 'folder-structure';
    case FOOD = 'food';
    case FUNNEL = 'funnel';
    case GITHUB = 'github';
    case GLOBE = 'globe';
    case GOOGLE = 'google';
    case GRID = 'grid';
    case GRID_BOTTOM = 'grid-bottom';
    case GRID_BOTTOM_LEFT = 'grid-bottom-left';
    case GRID_BOTTOM_RIGHT = 'grid-bottom-right';
    case GRID_FULL = 'grid-full';
    case GRID_LEFT = 'grid-left';
    case GRID_RIGHT = 'grid-right';
    case GRID_TOP = 'grid-top';
    case GRID_TOP_LEFT = 'grid-top-left';
    case GRID_TOP_RIGHT = 'grid-top-right';
    case H1 = 'h1';
    case H2 = 'h2';
    case H3 = 'h3';
    case H4 = 'h4';
    case H5 = 'h5';
    case H6 = 'h6';
    case HEADLINE = 'headline';
    case HEART = 'heart';
    case HEART_FILLED = 'heart-filled';
    case HEART_OUTLINE = 'heart-outline';
    case HIDDEN = 'hidden';
    case HOME = 'home';
    case IMAGE = 'image';
    case IMAGES = 'images';
    case IMPORT = 'import';
    case INFO = 'info';
    case INFO_CARD = 'info-card';
    case INSTAGRAM = 'instagram';
    case ITALIC = 'italic';
    case KEY = 'key';
    case KIRBY = 'kirby';
    case LAYERS = 'layers';
    case LAYOUT_COLUMNS = 'layout-columns';
    case LAYOUT_LEFT = 'layout-left';
    case LAYOUT_RIGHT = 'layout-right';
    case LINKEDIN = 'linkedin';
    case LIST_BULLET = 'list-bullet';
    case LIST_NUMBERS = 'list-numbers';
    case LIVE = 'live';
    case LOADER = 'loader';
    case LOCK = 'lock';
    case LOGOUT = 'logout';
    case MAP = 'map';
    case MARKDOWN = 'markdown';
    case MASTODON = 'mastodon';
    case MEGAPHONE = 'megaphone';
    case MENU = 'menu';
    case MERGE = 'merge';
    case MOBILE = 'mobile';
    case MONEY = 'money';
    case MOON = 'moon';
    case OPEN = 'open';
    case ORDER_ALPHA_ASC = 'order-alpha-asc';
    case ORDER_ALPHA_DESC = 'order-alpha-desc';
    case ORDER_NUM_ASC = 'order-num-asc';
    case ORDER_NUM_DESC = 'order-num-desc';
    case PAGE = 'page';
    case PALETTE = 'palette';
    case PARAGRAPH = 'paragraph';
    case PARENT = 'parent';
    case PAYPAL = 'paypal';
    case PEN = 'pen';
    case PHONE = 'phone';
    case PIN = 'pin';
    case PINTEREST = 'pinterest';
    case PIPETTE = 'pipette';
    case PLANE = 'plane';
    case PLAY = 'play';
    case PLUS = 'plus';
    case PREVIEW = 'preview';
    case PRINT = 'print';
    case PROTECTED = 'protected';
    case QR_CODE = 'qr-code';
    case QUESTION = 'question';
    case QUOTE = 'quote';
    case REFRESH = 'refresh';
    case REMOVE = 'remove';
    case ROCKET = 'rocket';
    case RSS = 'rss';
    case SEARCH = 'search';
    case SERVER = 'server';
    case SETTINGS = 'settings';
    case SHARE = 'share';
    case SHIELD = 'shield';
    case SHUFFLE = 'shuffle';
    case SHUT_SOWN = 'shut-down';
    case SITEMAP = 'sitemap';
    case SMILE = 'smile';
    case SORT = 'sort';
    case SPARKLING = 'sparkling';
    case SPLIT = 'split';
    case STAR = 'star';
    case STAR_FILLED = 'star-filled';
    case STAR_OUTLINE = 'star-outline';
    case STATUS_DRAFT = 'status-draft';
    case STATUS_LISTED = 'status-listed';
    case STATUS_UNLISTED = 'status-unlisted';
    case STORE = 'store';
    case STRIKETHROUGH = 'strikethrough';
    case SUBSCRIPT = 'subscript';
    case SUN = 'sun';
    case SUPERSCRIPT = 'superscript';
    case TABLE = 'table';
    case TABLET = 'tablet';
    case TAG = 'tag';
    case TEMPLATE = 'template';
    case TERMINAL = 'terminal';
    case TEXT = 'text';
    case TEXT_CENTER = 'text-center';
    case TEXT_JUSTIFY = 'text-justify';
    case TEXT_LEFT = 'text-left';
    case TEXT_RIGHT = 'text-right';
    case TICKET = 'ticket';
    case TIKTOK = 'tiktok';
    case TITLE = 'title';
    case TOGGLE_OFF = 'toggle-off';
    case TOGGLE_ON = 'toggle-on';
    case TRASH = 'trash';
    case UNDERLINE = 'underline';
    case UNDO = 'undo';
    case UNLOCK = 'unlock';
    case UPLOAD = 'upload';
    case URL = 'url';
    case USER = 'user';
    case USERS = 'users';
    case VIDEO = 'video';
    case VIMEO = 'vimeo';
    case WALLET = 'wallet';
    case WAND = 'wand';
    case WHATSAPP = 'whatsapp';
    case WHEELCHAIR = 'wheelchair';
    case WINDOW = 'window';
    case YOUTUBE = 'youtube';
}
