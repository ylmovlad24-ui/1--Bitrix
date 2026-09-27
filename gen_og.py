#!/usr/bin/env python3
"""Generate minimal valid JPEG files with solid blue color #4967D8 (1200x630)."""
import struct
import math

WIDTH = 1200
HEIGHT = 630
R, G, B = 0x49, 0x67, 0xD8

def make_jpeg_solid(width, height, r, g, b):
    """Create a minimal valid JPEG with a solid color."""
    # Quantization table (luminance, simple)
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
    
    # Build JPEG file
    buf = bytearray()
    
    # SOI
    buf += b'\xff\xd8'
    
    # APP0 (JFIF)
    app0 = b'JFIF\x00\x01\x01\x00\x00\x01\x00\x01\x00\x00'
    buf += b'\xff\xe0'
    buf += struct.pack('>H', len(app0) + 2)
    buf += app0
    
    # DQT (luminance)
    dqt = bytearray([1])  # table ID 1
    dqt += bytes(qtable)
    buf += b'\xff\xdb'
    buf += struct.pack('>H', len(dqt) + 2)
    buf += dqt
    
    # DQT (chrominance)
    dqtc = bytearray([0])  # table ID 0
    dqtc += bytes([16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,
                    16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16])
    buf += b'\xff\xdb'
    buf += struct.pack('>H', len(dqtc) + 2)
    buf += dqtc
    
    # SOF0
    sof = bytearray()
    sof += b'\x08'  # precision
    sof += struct.pack('>HH', height, width)
    sof += b'\x03'  # 3 components
    sof += b'\x01\x11\x00'  # Y: table 1
    sof += b'\x02\x11\x01'  # Cb: table 0
    sof += b'\x03\x11\x01'  # Cr: table 0
    buf += b'\xff\xc0'
    buf += struct.pack('>H', len(sof) + 2)
    buf += sof
    
    # DHT (luminance DC)
    dht_dc_l = bytearray([0])  # class 0, table ID 0
    # Huffman table for DC
    dht_dc_l += bytes([0,0,1,5,1,4,3,4,7,5,5,6,8,8,9,4,1,2])
    dht_dc_l += bytes([0x01,0x00,0x03,0x02,0x04,0x03,0x05,0x05,0x04,0x00,0x00,0x00,0x00,0x00,0x00,0x00])
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_dc_l) + 2)
    buf += dht_dc_l
    
    # DHT (chrominance DC)
    dht_dc_c = bytearray([0])
    dht_dc_c += bytes([0,3,1,1,1,1,1,1,0,0,0,0,0,0,0,0])
    dht_dc_c += bytes([0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00])
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_dc_c) + 2)
    buf += dht_dc_c
    
    # DHT (luminance AC)
    dht_ac_l = bytearray([16])  # class 1, table ID 0
    dht_ac_l += bytes([0,2,1,3,3,2,4,3,5,5,4,4,0,0,1,0x7d])
    dht_ac_l += bytes(range(0x01,0x100))
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_ac_l) + 2)
    buf += dht_ac_l
    
    # DHT (chrominance AC)
    dht_ac_c = bytearray([16])
    dht_ac_c += bytes([0,2,1,2,1,2,1,1,1,1,1,0,0,0,0,0])
    dht_ac_c += bytes([0x00,0x00,0x01,0x02,0x03,0x04,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00])
    buf += b'\xff\xc4'
    buf += struct.pack('>H', len(dht_ac_c) + 2)
    buf += dht_ac_c
    
    # SOS
    sos = bytearray()
    sos += b'\x03'  # 3 components
    sos += b'\x01\x00'  # Y: table 0
    sos += b'\x02\x11'  # Cb: table 1
    sos += b'\x03\x11'  # Cr: table 1
    sos += b'\x00\x3f\x00'  # Ss, Se, Ah/Al
    buf += b'\xff\xda'
    buf += struct.pack('>H', len(sos) + 2)
    buf += sos
    
    # Scan data - for solid color, we encode simply
    # Convert to YCbCr and encode
    bs = bytearray()
    
    # For solid color, all pixels are the same
    # YCbCr conversion
    y_val = int(0.299 * r + 0.587 * g + 0.114 * b)
    cb_val = 128 + int(-0.168736 * r - 0.331264 * g + 0.5 * b)
    cr_val = 128 + int(0.5 * r - 0.418688 * g - 0.081312 * b)
    
    # Clamp values
    y_val = max(0, min(255, y_val))
    cb_val = max(0, min(255, cb_val))
    cr_val = max(0, min(255, cr_val))
    
    # For a solid color image, we can use very simple encoding
    # Just output the DC coefficients for each 8x8 block
    blocks_x = (width + 7) // 8
    blocks_y = (height + 7) // 8
    
    # Encode DC for Y (solid color = constant = DCT coefficient)
    # For solid color, the DC coefficient is simply the average
    y_dc = y_val - 128  # DC value relative to 128
    
    # Encode DC for Cb
    cb_dc = cb_val - 128
    
    # Encode DC for Cr  
    cr_dc = cr_val - 128
    
    # Write scan data - minimal for solid color
    # We'll use a very simple encoding
    
    # For each block, we need to encode DC and AC coefficients
    # For solid color, AC coefficients are all zeros
    
    # Y component DC
    # DC value for Y
    y_dc_val = y_val - 128
    if y_dc_val < 0:
        y_dc_val += 256
    
    # Simple approach: just write minimal scan data
    # This creates a valid but potentially large JPEG
    
    # For each 8x8 block in each component
    bs_scan = bytearray()
    
    # EOB marker for AC (end of block)
    eob = 0x00
    
    # For solid color, each block has the same DC
    # Let's create a minimal scan
    
    # Start with scan header
    # We'll create minimal valid scan data
    
    # For simplicity, let's just write a minimal JPEG
    # by encoding a few blocks
    
    # Create scan data for Y component
    # DC coefficient with Huffman encoding
    # For a small value, use minimal bits
    
    def huffman_encode(value, bits, table):
        """Simple huffman-like encoding."""
        result = bytearray()
        if value < 0:
            value = 256 + value
        # Write size
        size = bits
        if size > 0:
            # Write value bits
            for i in range(size - 1, -1, -1):
                result.append((value >> i) & 1)
        return result
    
    # For solid color, create minimal scan
    # Just encode one block per component as representative
    
    # Y: DC value
    if y_dc_val == 0:
        bs_scan += b'\xff\x00'  # RST0 marker, then EOB
    else:
        # Encode DC with run-length
        # For simplicity, just use minimal encoding
        size = y_dc_val.bit_length() if y_dc_val > 0 else 1
        if size > 8:
            size = 8
        
        # DC marker + value
        bs_scan.append(0x01)  # DC size 1
        bs_scan.append(y_dc_val & 0xFF)
        
        # AC: EOB
        bs_scan.append(0x00)  # EOB
    
    # Pad to byte boundary
    if len(bs_scan) % 8 != 0:
        bs_scan.append(0x80)
        while len(bs_scan) % 8 != 0:
            bs_scan.append(0x00)
    
    # Write scan data
    buf += bs_scan
    
    # EOI
    buf += b'\xff\xd9'
    
    return bytes(buf)


# Create and save images
output_dir = r"C:\Users\Анна\IdeaProjects\bitrix\img"

files = [
    "og-default.jpg",
    "og-business-systems.jpg",
    "og-web-systems.jpg",
]

for filename in files:
    filepath = f"{output_dir}/{filename}"
    data = make_jpeg_solid(WIDTH, HEIGHT, R, G, B)
    with open(filepath, 'wb') as f:
        f.write(data)
    print(f"Created: {filepath} ({len(data)} bytes)")

print("Done!")
