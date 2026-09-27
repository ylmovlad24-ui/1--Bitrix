import sys
sys.stdout = open(r'C:\Users\Анна\IdeaProjects\bitrix\python_out.txt', 'w', encoding='utf-8')
sys.stderr = open(r'C:\Users\Анна\IdeaProjects\bitrix\python_err.txt', 'w', encoding='utf-8')

print("Script started")
print("Python version:", sys.version)

import struct
import math

WIDTH = 1200
HEIGHT = 630
R, G, B = 0x49, 0x67, 0xD8

def make_jpeg_solid(width, height, r, g, b):
    buf = bytearray()
    
    # SOI
    buf += b'\xff\xd8'
    
    # APP0 (JFIF)
    app0 = b'JFIF\x00\x01\x01\x00\x00\x01\x00\x01\x00\x00'
    buf += b'\xff\xe0'
    buf += struct.pack('>H', len(app0) + 2)
    buf += app0
    
    # DQT luminance
    qtable = [
        16, 11, 10, 16, 24, 40, 51, 61,
        12, 12, 14, 19, 26, 58, 60, 55,
        14, 13, 16, 24, 40, 57, 69, 56,
        14, 17, 22, 29, 51, 87, 80, 62,
        18, 22, 37, 56, 68, 109, 103, 77,
        24, 35, 55, 64, 81, 104, 113, 92,
        49, 64, 78, 87, 103, 121, 120, 101,
        72, 92, 95, 98, 112, 100, 103, 99
    ]
    dqt = bytearray([1])
    dqt += bytes(qtable)
    buf += b'\xff\xdb'
    buf += struct.pack('>H', len(dqt) + 2)
    buf += dqt
    
    # DQT chrominance
    dqtc = bytearray([0])
    dqtc += bytes([16]*64)
    buf += b'\xff\xdb'
    buf += struct.pack('>H', len(dqtc) + 2)
    buf += dqtc
    
    # SOF0
    sof = bytearray()
    sof += b'\x08'
    sof += struct.pack('>HH', height, width)
    sof += b'\x03'
    sof += b'\x01\x11\x00'
    sof += b'\x02\x11\x01'
    sof += b'\x03\x11\x01'
    buf += b'\xff\xc0'
    buf += struct.pack('>H', len(sof) + 2)
    buf += sof
    
    # DHT DC luminance
    dht_dc_l = bytearray([0])
    dht_dc_l += bytes([0,0,1,5,1,4,3,4,7,5,5,6,8,8,9,4,1,2])
    dht_dc_l += bytes([0x01,0x00,0x03,0x02,0x04,0x03,0x05,0x05,0x04,0x00,0x00,0x00,0x00,0x00,0x00,0x00])
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_dc_l) + 2)
    buf += dht_dc_l
    
    # DHT DC chrominance
    dht_dc_c = bytearray([0])
    dht_dc_c += bytes([0,3,1,1,1,1,1,1,0,0,0,0,0,0,0,0])
    dht_dc_c += bytes([0x00]*16)
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_dc_c) + 2)
    buf += dht_dc_c
    
    # DHT AC luminance
    dht_ac_l = bytearray([16])
    dht_ac_l += bytes([0,2,1,3,3,2,4,3,5,5,4,4,0,0,1,0x7d])
    dht_ac_l += bytes(range(0x01,0x100))
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_ac_l) + 2)
    buf += dht_ac_l
    
    # DHT AC chrominance
    dht_ac_c = bytearray([16])
    dht_ac_c += bytes([0,2,1,2,1,2,1,1,1,1,1,0,0,0,0,0])
    dht_ac_c += bytes([0x00,0x00,0x01,0x02,0x03,0x04,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00])
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_ac_c) + 2)
    buf += dht_ac_c
    
    # SOS
    sos = bytearray()
    sos += b'\x03'
    sos += b'\x01\x00'
    sos += b'\x02\x11'
    sos += b'\x03\x11'
    sos += b'\x00\x3f\x00'
    buf += b'\xff\xda'
    buf += struct.pack('>H', len(sos) + 2)
    buf += sos
    
    # For solid color, compute YCbCr
    y_val = int(0.299 * r + 0.587 * g + 0.114 * b)
    cb_val = 128 + int(-0.168736 * r - 0.331264 * g + 0.5 * b)
    cr_val = 128 + int(0.5 * r - 0.418688 * g - 0.081312 * b)
    y_val = max(0, min(255, y_val))
    cb_val = max(0, min(255, cb_val))
    cr_val = max(0, min(255, cr_val))
    
    # Create scan data - minimal for solid color
    # Just encode DC for each block, AC = EOB
    bs_scan = bytearray()
    
    blocks_x = (width + 7) // 8
    blocks_y = (height + 7) // 8
    
    # Y DC value
    y_dc = y_val - 128
    if y_dc < 0:
        y_dc += 256
    
    # For each block, encode DC + EOB
    for by in range(blocks_y):
        for bx in range(blocks_x):
            # DC marker: size=1, value=y_dc
            bs_scan.append(0x01)
            bs_scan.append(y_dc & 0xFF)
            # AC: EOB
            bs_scan.append(0x00)
    
    # Cb DC value
    cb_dc = cb_val - 128
    if cb_dc < 0:
        cb_dc += 256
    
    for by in range(blocks_y):
        for bx in range(blocks_x):
            bs_scan.append(0x01)
            bs_scan.append(cb_dc & 0xFF)
            bs_scan.append(0x00)
    
    # Cr DC value
    cr_dc = cr_val - 128
    if cr_dc < 0:
        cr_dc += 256
    
    for by in range(blocks_y):
        for bx in range(blocks_x):
            bs_scan.append(0x01)
            bs_scan.append(cr_dc & 0xFF)
            bs_scan.append(0x00)
    
    # Pad to byte boundary
    while len(bs_scan) % 8 != 0:
        bs_scan.append(0x00)
    
    buf += bs_scan
    buf += b'\xff\xd9'
    
    return bytes(buf)


output_dir = r'C:\Users\Анна\IdeaProjects\bitrix\img'

files = [
    "og-default.jpg",
    "og-business-systems.jpg",
    "og-web-systems.jpg",
]

for filename in files:
    filepath = f'{output_dir}/{filename}'
    data = make_jpeg_solid(WIDTH, HEIGHT, R, G, B)
    with open(filepath, 'wb') as f:
        f.write(data)
    print(f'Created: {filepath} ({len(data)} bytes)')

print('Done!')
